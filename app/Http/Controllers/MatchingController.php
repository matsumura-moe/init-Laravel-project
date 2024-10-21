<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\idol;
use App\Models\UserIdol;
use Illuminate\Support\Facades\Auth;

class MatchingController extends Controller
{
    const MIN_MATCHING_COUNT = 1;

    public function show(User $user)
    {
        
        $user = Auth::user(); // ログインユーザーを取得

        // 好きなアイドルがいない場合のチェック
        if (!$user->idols || $user->idols->isEmpty()) {
            return back()->with('error', 'This user has no favorite idols.');
        }

         // ユーザーの好きなアイドルのIDを取得
        $idol_ids = $user->idols->pluck('id');
        
        // マッチする他のユーザーと共通のアイドルを取得し、降順に並べ替える
        $matching_users = User::where('id', '!=', $user->id) // ログインユーザー以外を対象
            ->whereHas('idols', function ($query) use ($idol_ids) {
                // 共通のアイドルがあるかをチェック
                $query->whereIn('idol_id', $idol_ids);
            })
            ->with(['idols' => function ($query) use ($idol_ids) {
                // 共通のアイドルのみを取得
                $query->whereIn('idol_id', $idol_ids);
            }])
            ->withCount(['idols' => function ($query) use ($idol_ids) {
                // 共通のアイドルの数をカウント
                $query->whereIn('idol_id', $idol_ids);
            }])
            ->having('idols_count', '>=', self::MIN_MATCHING_COUNT) // 共通アイドルの数が1以上
            ->orderBy('idols_count', 'desc') // 共通アイドル数で降順に並べ替え
            ->get();

        // ビューにデータを渡して表示
        return view('matching', [
            'user' => $user,
            'matching_users' => $matching_users,
        ]);
    }
}
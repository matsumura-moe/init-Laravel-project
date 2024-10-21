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
        
        // マッチする他のユーザーを取得
        $matching_users = User::where('id', '!=', $user->id) // ログインしているユーザーを除外
    ->whereHas('idols', function ($query) use ($idol_ids) {
        // 共通のアイドルがあるかをチェック
        $query->whereIn('idol_id', $idol_ids);
    })
    ->withCount(['idols' => function ($query) use ($idol_ids) {
        // 一致するアイドルの数をカウント
        $query->whereIn('idol_id', $idol_ids);
    }])
    ->having('idols_count', '>=', self::MIN_MATCHING_COUNT) // 最低マッチ数
    ->orderBy('idols_count', 'desc') // 降順に並べ替え
    ->get();

        // ビューにデータを渡して表示
        return view('matching', [
            'user' => $user,
            'matching_users' => $matching_users,
        ]);
    }
}
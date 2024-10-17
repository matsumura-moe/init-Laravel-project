<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MatchingController extends Controller
{
    const MIN_MATCHING_COUNT = 1;

    public function show(User $user)
    {
        $idol_ids = $user->idols->pluck('id');
        $matched_users = User::with(['idols' => function($query) use($idol_ids){ // 同じ「好きなアイドル」を取得

            $query->whereIn('idol_id', $idol_ids);

        }])
        ->where('id', '!=', $user->id)  // 自分以外のデータを取得
        ->get()
        ->filter(function($matched_user){ // 最低でも `MIN_MATCHING_COUNT` 以上マッチするものだけ

            return ($matched_user->idols->count() >= self::MIN_MATCHING_COUNT);

        })
        ->sortByDesc(function($matched_user) { // マッチしたアイドルの数で並べ替え（降順）

            return $matched_user->comedians->count();

        });

        return view('matching')->with([
            'user' => $user,
            'matched_users' => $matched_users
        ]);
    }
}

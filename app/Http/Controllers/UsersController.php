<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;                        // 追加 認証
use App\Models\User;   
use App\Models\Idol;                                     // 追加　ユーザ情報

class UsersController extends Controller
{
    public function index()                                 // 追加 ユーザ一覧      
    {                                                       // 追加
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10); // 追加

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [                        // 追加
            'users' => $users,                              // 追加
        ]);                                                 // 追加
    }                                                       // 追加
    
    public function show($id)                               // 追加　個別詳細ページ
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        $idols = Idol::all();
        
        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'idols' => $idols,
        ]);                                                 // 追加
    }                                                       // 追加

    public function store(Request $request)
    {

    }
}
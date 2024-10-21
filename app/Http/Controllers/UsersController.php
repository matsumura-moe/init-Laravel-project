<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;                    // 追加 認証
use App\Models\User;   
use App\Models\Idol;                                    // 追加　ユーザ情報
use Illuminate\Support\Facades\Storage;                 // 追加


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

    public function updateImage(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // ログインユーザーと更新対象のユーザーが同じか確認
        if (Auth::id() !== $user->id) {
            return redirect()->back()->with('error', '許可されていない操作です。');
        }

        // バリデーション: ファイルが画像であるかどうか
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 古い画像を削除する（必要に応じて）
        if ($user->image_path) {
            Storage::delete('public/' . $user->image_path);
        }

        // 新しい画像を保存する
        $path = $request->file('image')->store('users', 'public');

        // 画像のパスをデータベースに保存する
        $user->image_path = $path;
        $user->save();

        return redirect()->back()->with('success', '画像が更新されました。');
    }

}
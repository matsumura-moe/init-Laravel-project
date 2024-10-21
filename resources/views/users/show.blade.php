@extends('layouts.app')

@section('content')
    <div class="flex gap-4">
        <div>
            <aside class="mt-4">
                {{-- ユーザ情報 --}}
                @include('users.card')
            </aside>
        </div>

        <div class="ml-4 overflow-y-auto h-[400px]"> 
        {{-- 現在ログインしているユーザーのページかどうかを確認 --}}
        @if (Auth::id() === $user->id) <!-- 自分のページかどうか -->
            <label class="block" for="idols">推しメンを選択してください(複数選択可)</label>
            @foreach($idols as $idol)
                <div class="flex justify-between items-center w-full border p-2"> <!-- w-full で横幅を統一 -->
                    <span>{{ $idol->name }}</span> <!-- 名前を左側に配置 -->
                    {{-- favorite/unfavoriteボタン --}}
                    @include('idol_favorite.favorite_button') <!-- ボタンを右側に配置 -->
                </div>
            @endforeach
        @else
            <label class="block" for="idols">推しメン一覧</label>
            @foreach($user->idols as $idol) <!-- 他のユーザーのお気に入りアイドルを表示 -->
            <div class="flex justify-between items-center w-full border p-2"> <!-- w-full で横幅を統一 -->
                    <span>{{ $idol->name }}</span> <!-- 名前を左側に配置 -->
                </div>
            @endforeach
        @endif
        </div>
</div>
@endsection
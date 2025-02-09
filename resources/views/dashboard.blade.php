@extends('layouts.app')

@section('content')
    @if (!Auth::check())
    <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
        <div class="hero-content text-center my-10">
            <div class="max-w-md mb-10">
                <h2 style="white-space: nowrap;">アイドル好きマッチングサイトへようこそ</h2>
                {{-- ユーザ登録ページへのリンク --}}
                <a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}">Sign up now!</a>
            </div>
        </div>
    </div>
    @else
    <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
        <div class="hero-content text-center my-10">
            <div class="max-w-md mb-10">
                <h2 style="white-space: nowrap;">アイドル好きマッチングサイトへようこそ</h2>
                <p>profileから推しを選択できます</p>
                <p>Matchingから推しが同じユーザーを探すことができます</p>
            </div>
        </div>
    </div>
    @endif
@endsection


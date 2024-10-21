@extends('layouts.app')

@section('content')
    <div class="flex items-center gap-4">
        <div>
            <aside class="mt-4">
                {{-- ユーザ情報 --}}
                @include('users.card')
            </aside>
        </div>
        <div>
            <label class="block" for="idols">Select your favorite idols:</label>
            @foreach($idols as $idol)
                <div class="flex">
                    {{ $idol->name }}
                    {{-- favorite/unfavoriteボタン --}}
                    @include('idol_favorite.favorite_button') 
                </div>
            @endforeach
        </div>

    </div>
@endsection
@extends('layouts.app')

@section('content')


<div id="app" class="p-4">
    <h5>{{ $user->name }} さん</h5>
    <div>
        <span>好きなアイドル</span> {{ $user->idols->pluck('name')->join('、') }}
    </div>
    <hr>
    <h6>マッチしたユーザー</h6>
    <ul class="list-unstyled">
    @foreach($matching_users as $matching_user)
        <li class="border rounded p-3 mb-3" style="background-color: #f0f8ff;">
            <!-- ユーザー名 -->
            <strong>{{ $matching_user->name }} さん</strong><br>
            <!-- マッチしたアイドル -->
            <span class="badge bg-success">マッチしたアイドル</span>（{{ $matching_user->idols->count() }}件）
            {{ $matching_user->idols->pluck('name')->join('、') }}
        </li>
    @endforeach
    </ul>
</div>
</body>
</html>
@endsection
@if (Auth::id() == $user->id)
    @if (Auth::user()->is_favorites($idol->id))
        {{-- unfavoriteボタンのフォーム --}}
        <form method="POST" action="{{ route('favorites.unfavorite', $idol->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-error btn-block normal-case" 
                onclick="return confirm('id = {{ $idol->id }} を推しから外します。よろしいですか？')">推し解除</button>
        </form>
    @else
        {{-- favoriteボタンのフォーム --}}
        <form method="POST" action="{{ route('favorites.favorite', $idol->id) }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-block normal-case">推し</button>
        </form>
    @endif
@endif
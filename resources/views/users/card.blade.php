<div class="card border border-base-300">
    <div class="card-body bg-base-200 text-4xl">
        <h2 class="card-title">{{ $user->name }}</h2>
    </div>
    <figure>
        {{-- ユーザが画像をアップロードしているかチェック --}}
        @if ($user->image_path)
            <img src="{{ asset('storage/' . $user->image_path) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full">
        @else
            <img src="{{ Gravatar::get($user->email, ['size' => 400]) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full">
        @endif
    </figure>
    {{-- 画像アップロードフォーム --}}
    @if (Auth::id() === $user->id) <!-- ログイン済みのユーザのみ画像をアップロードできるようにする -->
        <form action="{{ route('user.updateImage', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="image">画像をアップロード→</label>
            <input type="file" name="image" accept="image/*" class="mt-2">
            <button type="submit" class="btn btn-primary mt-2">画像を変更</button>
        </form>
    @endif
</div>
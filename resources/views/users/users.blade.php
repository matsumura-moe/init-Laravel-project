@if (isset($users))
    <ul class="list-none">
        @foreach ($users as $user)
            <li class="flex items-center gap-x-2 mb-4">
                {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                <div class="avatar">
                    <div class="w-12 rounded">
                    @if ($user->image_path)
                        <img src="{{ asset('storage/' . $user->image_path) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full">
                    @else
                        <img src="{{ Gravatar::get($user->email, ['size' => 400]) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full">
                    @endif
                    </div>
                </div>
                <div>
                    <div>
                        {{ $user->name }}
                    </div>
                    <div>
                        {{-- ユーザ詳細ページへのリンク --}}
                        <p><a class="link link-hover text-info" href="{{ route('users.show', $user->id) }}">View profile</a></p>
                    </div>
                </div>
            </li>
            @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $users->links() }}
@endif
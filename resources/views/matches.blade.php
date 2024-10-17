@foreach ($matches as $match)
    <div>
        <h3>{{ $match->name }}</h3>
        <p>Common idols: {{ $match->idols->pluck('name')->implode(', ') }}</p>
    </div>
@endforeach
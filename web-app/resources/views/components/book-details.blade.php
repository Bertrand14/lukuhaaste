<div>
    <img class="object-cover" src="{{ asset('images/covers/' . $book->cover) }}" alt="{{$book->title}}">
</div>

<div>
    <h1 class="text-xl font-bold">{{ $book->title }}</h1>

    <div x-data='{ book: @json($book) }' class="grid grid-cols-2 gap-4">
        <p class="author">Kirjoittaja: </p>
        <span x-text="book.author_full_name"></span>

        <p class="author">Genre: </p>
        <span x-text="book.genre_names"></span>


        <p>Average rating: </p>
        @if ($noteCount > 0)
        <p>{{ number_format($noteAvg, 2) }} / 5 ({{ $noteCount }} {{ Str::plural('review', $noteCount) }})</p>
        @else
        <p>-</p>
        @endif

        <p>Recommended by: </p>
        @if ($recommend > 0)
        <p>{{ number_format($recommendPrct, 2) }}% ({{ $recommend }} {{ Str::plural('reader', $recommend) }})</p>
        @else
        <p>-</p>
        @endif
    </div>

</div>
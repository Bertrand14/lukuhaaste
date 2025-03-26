<section id="bestbooks" class="lg:gap-4 gap-2 ">
    <div id="mostRead" class="splide" aria-label="Luetuimpien kirjojen esittely">
        <h2>Luetuimmat kirjat</h2>
        <div class="splide__slider">
            <div class="splide__track">
                <ul class="splide__list" class="grid justify-items-stretch content-stretch">
                    @foreach($bestBooks as $book)
                    <li class="splide__slide w-full aspect-[3/4] relative overflow-hidden" data-bookID="{{$book->bookID}}" aria-label="{{$book->title}}">
                        <img class=" object-cover" src="{{ asset('images/covers/' . $book->cover) }}" alt="{{$book->title}}">
                        <span>{{$book->title}}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="splide__progress">
            <div class="splide__progress__bar">
            </div>
        </div>
    </div>
    <div id="mostLike" class="splide" aria-label="Suosituimpien kirjojen esittely">
        <h2>Suosikki-kirjat</h2>
        <div class="splide__slider">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach($lovedBooks as $book)
                    <li class="splide__slide w-full aspect-[3/4] relative overflow-hidden" data-bookID="{{$book->bookID}}" aria-label="{{$book->title}}">
                        <img class="object-cover" src="{{ asset('images/covers/' . $book->cover) }}" alt="{{$book->title}}">
                        <span>{{$book->title}}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="splide__progress">
            <div class="splide__progress__bar"></div>
        </div>
    </div>
</section>
<section id="achievements-container" class="half-width">
    <h2>Yhteisön saavutukset</h2>
    <div id="achievements-stats">
        @php
        $achievements = [
        'pages' => ['count' => $stats['countPages'], 'label' => 'luettua sivua'],
        'books' => ['count' => $stats['countBooks'], 'label' => 'luettua kirjaa'],
        'reader' => ['count' => $stats['countReaders'], 'label' => 'lukijaa'],
        'events' => ['count' => $stats['countEvents'], 'label' => 'haastetta'],
        ];
        @endphp

        @foreach ($achievements as $key => $achievement)
        <div id="achievements-{{ $key }}" class="counter-container">
            <span class="counter" id="{{ $key }}-number" data-quantity="{{ $achievement['count'] }}">
                {{ $achievement['count'] }}
            </span>
            <span class="label">{{ $achievement['label'] }}</span>
        </div>
        @endforeach

    </div>
</section>
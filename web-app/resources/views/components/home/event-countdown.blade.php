<section id="countdown-container" class="items-end">
    <div class="max-w-lg flex flex-col content-center rounded-sm p-5 m-4 gap-6">
        @if($current OR $future)
        @php $timestamp = ($current) ? strtotime($current['endDate']) : strtotime($future['startDate']); @endphp
        <h2>{{ ($current) ? $current['name'] : $future['name'] }}</h2>
        <p>{{ ($current) ? $current['description'] : $future['description']}}</p>
        <div id="countdown-timer" class="flex lg:gap-4 gap-2 justify-center" data-time="{{ $timestamp }}">
            @php
            $countdown = [
            'days' => 'päivää',
            'hours' => 'tuntia',
            'minutes' => 'minuuttia',
            'seconds' => 'sekuntia',
            ];
            @endphp

            @foreach ($countdown as $key => $label)
            <div id="countdown-{{ $key }}" class="counter-container ">
                <span id="countdown-{{ $key }}-number" class="counter"></span>
                <span class="label">{{ $label }}</span>
            </div>
            @endforeach

        </div>
        @else
        <h2>Ei suunniteltu haasteita toistaiseksi.</h2>
        @endif
    </div>
</section>
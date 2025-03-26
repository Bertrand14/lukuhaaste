@php

$explanations = [
['title' => 'Ilmoittautuminen', 'description' => 'Ilmoittaudu Lukuhaasteeseen verkkosovelluksemme kautta ja vastaanota haastepäiväkirjasi.'],
['title' => 'Lukeminen', 'description' => 'Valitse joka kuukausi kirja monipuolisesta valikoimastamme, joka kattaa sekä suomalaisen kirjallisuuden klassikot että kansainväliset bestsellerit.'],
['title' => 'Pisteiden kerääminen', 'description' => 'Osallistu lukemishaasteisiin ja ansaitse pisteitä vastaamalla kysymyksiin, jakamalla mielipiteitäsi ja osallistumalla verkkokeskusteluihin.'],
['title' => 'Palkinnot', 'description' => 'Kerää pisteitä ja vaihda ne jännittäviin palkintoihin, kuten ilmaisia kirjoja, lehtitilauksia ja lahjakortteja.']
];
@endphp
<section id="explanations" class="no-bg">
    @foreach ($explanations as $item)
    <div class="card">
        <h2>{{ $item['title'] }}</h2>
        <p>{{ $item['description'] }}</p>
    </div>
    @endforeach
</section>
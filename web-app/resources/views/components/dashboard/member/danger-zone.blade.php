<div x-data="{ options: true, endChallenge: false, removeReviews: false, deleteAccount: false }" class=" overflow-hidden shadow-sm sm:rounded-lg ">
  <h3 class="lg:text-3xl text-lg font-bold text-center">Vaara-alue</h3>
  <div x-show="options" class="danger-zone-container rounded-lg ">

    <div class="flex p-5 border-b-2 border-b-zinc-500">
      <div class="w-3/4">
        <h4 class="lg:text-2xl text-lg font-bold">Päätä nykyinen haaste</h4>
        <p>Osallistumisesi perutaan ja kaikki merkintäsi tähän haasteeseen mitätöidään.</p>
      </div>
      <div class="w-1/4 flex items-center justify-end">
        <button @click="endChallenge = true; options = false" class="rounded-md px-4 py-2 border border-red-900 bg-zinc-100 dark:bg-zinc-800 text-red-500 hover:bg-red-500 hover:text-zinc-700">Päätä haaste</button>
      </div>
    </div>

    <div class="flex p-5 border-b-2 border-b-zinc-500">
      <div class="w-3/4">
        <h4 class="lg:text-2xl text-lg font-bold">Poista arvosteluni</h4>
        <p>Poistaa kaikki tähän asti tekemäsi arvostelu.</p>
      </div>
      <div class="w-1/4 flex items-center justify-end">
        <button @click="removeReviews = true; options = false" class="rounded-md px-4 py-2 border border-red-900 bg-zinc-100 dark:bg-zinc-800 text-red-500 hover:bg-red-500 hover:text-zinc-700">Poista arvosteluni</button>
      </div>
    </div>

    <div class="flex p-5">
      <div class="w-3/4">
        <h4 class="lg:text-2xl text-lg font-bold">Poista tilini</h4>
        <p>Poistaa tilisi mutta säilyttää kaikki tekemäsi arvostelut</p>
      </div>
      <div class="w-1/4 flex items-center justify-end">
        <button @click="deleteAccount = true; options = false" class="rounded-md px-4 py-2 border border-red-900 bg-zinc-100 dark:bg-zinc-800 text-red-500 hover:bg-red-500 hover:text-zinc-700">Poista tilini</button>
      </div>
    </div>

  </div>

  <div x-show="endChallenge">
    <h2>Oletko varma, että haluat jättää nykyisen haasteen? Kaikki edistymisesi poistetaan.</h2>
    <button @click="endChallenge = false; options = true" class="bg-gray-500 text-white px-4 py-2 mt-4 rounded">En</button>
    <form method="POST" action="{{ route('event.exit') }}" class="reviews-delete">
      @csrf
      @method('POST')
      <button type="submit" class="validAction bg-red-500 text-white px-4 py-2 mt-4 rounded">Kyllä</button>
    </form>
  </div>

  <div x-show="removeReviews">
    <h2>Haluatko varmasti poistaa kaikki tähän mennessä tekemäsi arvostelut? Kun se on poistettu, takaisin ei voi palata. Varmista, että haluat tehdä tämän.</h2>
    <button @click="removeReviews = false; options = true" class="bg-gray-500 text-white px-4 py-2 mt-4 rounded">En</button>
    <form method="POST" action="{{ route('reviews.deleteFromUser') }}" class="reviews-delete">
      @csrf
      @method('DELETE')
      <button type="submit" class="validAction bg-red-500 text-white px-4 py-2 mt-4 rounded">Kyllä</button>
    </form>
  </div>
  <div x-show="deleteAccount">
    <h2>Haluatko varmasti poistaa tilisi ? Kun olet poistanut sen, paluuta ei ole. Ole varma.</h2>
    <button @click="deleteAccount = false; options = true" class="cancelAction bg-gray-500 text-white px-4 py-2 mt-4 rounded">En</button>
    <form method="POST" action="{{ route('account.delete') }}" class="account-delete">
      @csrf
      @method('DELETE')
      <button type="submit" class="validAction bg-red-500 text-white px-4 py-2 mt-4 rounded">Kyllä</button>
    </form>
  </div>
</div>
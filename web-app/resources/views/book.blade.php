<x-app-layout>
  <div class="book flex flex-col items-center ">

    <div class="details ">
      <x-book-details :book="$book" :noteCount="$noteCount" :noteAvg="$noteAvg" :recommend="$recommend" :recommendPrct="$recommendPrct" />
    </div>

    <div class="reviews">
      <x-book-reviews :book="$book" :reviews="$reviews" />
    </div>

  </div>
</x-app-layout>
<x-app-layout>

  <div class="home flex flex-col justify-around items-center my-10">

    <x-home.presentation />

    <x-home.event-countdown :current=$current />

    <x-home.event-achievements :stats=$stats />

    <x-home.event-explanation />

    <x-home.best-books :bestBooks=$bestBooks :lovedBooks=$lovedBooks />

  </div>
</x-app-layout>
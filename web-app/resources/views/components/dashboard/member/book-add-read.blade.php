<div x-data="{ readBook: false, addBook: false }">
    <button 
    @click="readBook = true"
    class="rounded-md py-2 px-3 bg-zinc-100 text-black hover:bg-zinc-200 dark:bg-zinc-600 dark:text-white dark:hover:bg-zinc-700"
    title="Olen lukenut uuden kirjan !">
    Luin uuden kirjan
  </button>

  <form x-data="{ 
    bookID: '', 
    bookName: '', 
    isValid() { return this.bookName.length >= 3; } 
  }"
  x-show="readBook" 
  x-cloak
  class="grid max-w-[50%] ml-10"
  action="{{ route('book.toEvent') }}"
  method="POST"
  enctype="multipart/form-data">
  @csrf
  <input type="hidden" id="bookID" name="bookID" x-model="bookID">

  <input type="text" id="bookName" name="bookName" 
    x-model="bookName"
    class="cursor-text placeholder:text-zinc-100 placeholder:italic mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-zinc-500 focus:ring focus:ring-zinc-500 focus:ring-opacity-50 cursor-pointer dark:bg-zinc-600 dark:hover:bg-zinc-700 dark:text-white" 
    placeholder="Kirjannimi"
    onkeyup="searchBooks(this.value)"
    required>

  <ul id="booksNameMatchesList" 
    class="max-h-32 overflow-auto rounded-md dark:bg-zinc-600 dark:text-white">
  </ul>

  <input x-show="bookID !== ''" type="number" id="pagesReadNumber" name="pagesReadNumber" 
    class="cursor-text [appearance:textfield] placeholder:text-zinc-100 placeholder:italic mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-zinc-500 focus:ring focus:ring-zinc-500 focus:ring-opacity-50 dark:bg-zinc-600 dark:hover:bg-zinc-700 dark:text-white" 
    min="0" max="9999" maxlength="4" size="4" 
    placeholder="Luettujen sivujen määrä" required>

    <select x-show="bookID !== ''" id="typeID" name="typeID" multiple class="mt-1 block w-full rounded-md dark:bg-zinc-700 dark:text-white" required>
    @foreach($booksFormats as $format)
     <option value="{{ $format->id }}" class="pb-1 border-b-2 border-zinc-800 dark:bg-zinc-700 dark:text-white dark:hover:bg-zinc-600">{{ $format->title }}</option>
    @endforeach
   </select>

  <button type="submit"
    x-show="bookID !== ''"
    :disabled="!isValid()"
    class="rounded-md py-2 px-3 bg-zinc-100 text-black hover:bg-zinc-200 dark:bg-zinc-600 dark:text-white dark:hover:bg-zinc-700">
    Tallenna luetuksi
  </button>

  <button @click.prevent="addBook = true" 
    x-show="bookID === ''"
    :disabled="!isValid()"
    class="rounded-md py-2 px-3 bg-zinc-100 text-black hover:bg-zinc-200 dark:bg-zinc-600 dark:text-white dark:hover:bg-zinc-700">
    Tallenna uusi teos
  </button>
</form>
  <div x-show="addBook" x-cloak>
    <x-dashboard.member.book-new :action="'new'" />
  </div>
</div>

<script>
  function searchBooks(searchInput) {
 const matchesList = document.getElementById('booksNameMatchesList');

 if (searchInput.length >= 3) {
  fetch(`/books/search?search=${searchInput}`)
  .then(response => response.json())
  .then(data => {
   matchesList.innerHTML = '';

   data.forEach(book => {
   let listItem = document.createElement('li');
   listItem.classList.add('p-1', 'border-b-2', 'border-zinc-150', 'cursor-pointer', 'hover:text-zinc-100', 'dark:hover:bg-zinc-700');
   listItem.textContent = book.title;

   listItem.addEventListener('click', () => {
    const bookIDInput = document.getElementById('bookID');
    const bookNameInput = document.getElementById('bookName');

    bookIDInput.value = book.id;
    bookNameInput.value = book.title;

    // Déclencher un événement input pour informer Alpine.js (Merci chatGPT)
    bookIDInput.dispatchEvent(new Event('input', { bubbles: true }));
    bookNameInput.dispatchEvent(new Event('input', { bubbles: true }));

    matchesList.innerHTML = ''; // On vide la liste après la sélection
   });

   matchesList.appendChild(listItem);
   });
  })
  .catch(error => {
   console.error('Error:', error);
  });
 } else {
  matchesList.innerHTML = '';
 }
}

</script>
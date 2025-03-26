function searchBooks(searchInput) {
 const matchesList = document.getElementById('booksNameMatchesList');

 if (searchInput.length >= 3) {
  fetch(`/books/search?bookName=${searchInput}`)
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

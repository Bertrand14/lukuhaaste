<div id="search-bar-container" class="order-3 lg:order-2">

    <div class="flex items-center" id="search-bar">
        <i class="fa fa-solid fa-magnifying-glass"></i>

        <div x-data="{ 
                search: '', 
                isValid() { return this.search.length >= 3; },
                isEmpty() { return this.search.length == 0;},
            }"
            class="w-100"
            x-cloak
            method="GET"
            enctype="multipart/form-data">
            @csrf

            <input type="text" id="search" name="search"
                x-model="search"
                placeholder="Etsi kirja..."
                onkeyup="searchBarBooks(this.value)"
                required>
            <ul id="search-results" class="max-h-28 overflow-auto rounded-sm ">
            </ul>
            <div class="errorMessage" x-show="!isEmpty() && !isValid()" class="text-red-500 text-sm ">Kirjoita vähintään 3 merkkiä.
            </div>

        </div>
    </div>
</div>
<!-- TODO move to own js file -->
<script>
    function searchBarBooks(searchInput) {
        const matchesList = document.getElementById('search-results');

        if (searchInput.length >= 3) {
            fetch(`/books/search?search=${searchInput}`)
                .then(response => response.json())
                .then(data => {
                    matchesList.innerHTML = '';



                    data.forEach(book => {
                        let listItem = document.createElement('li');
                        listItem.classList.add('p-1', 'border-b-2', 'border-zinc-150', 'cursor-pointer', 'hover:text-zinc-100', 'dark:hover:bg-zinc-700');

                        // Create anchor tag
                        let link = document.createElement('a');
                        link.href = "/books/" + book.id + "_" + encodeURIComponent(book.title.replace(/\s+/g, '_'));
                        link.textContent = book.title;
                        link.classList.add('block', 'w-full', 'h-full', 'p-1');

                        console.log(encodeURIComponent(book.title));
                        console.log(link.href);

                        // Append link to list item
                        listItem.appendChild(link);
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
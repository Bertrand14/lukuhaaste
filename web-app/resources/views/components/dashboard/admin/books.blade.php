<h2>Kirjat</h2>


<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('bookFilter', () => ({
            search: '',
            books: @json($books),

            // TODO enable search also on genre / authors
            filteredBooks() {
                return this.books.filter(book => ['title'].some(key =>
                    book[key]?.toLowerCase().includes(this.search.toLowerCase())
                ));
            },

        }));

    });

    /*
    function updateBooktitle(book, title) {
        fetch(`/book/${book.id}`)
            .then(response => response.json())
            .then(data => {
                book.title = title;
                updateBook(title);
            })
            .catch(error => {
                console.error('Error fetching book info:', error);
                alert('Error fetching book information!');
            });
    }

    function updateBook(book) {
        fetch(`/update-book/${book.id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    title: book.title
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the book object with new values
                    book.title = data.title;
                    alert('Book details updated successfully!');
                } else {
                    alert('Error updating book details!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating book details!');
            });
    }

    function deleteBook(book) {
        alert("todo");
        

            if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                fetch(`/delete-user/${user.id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('User deleted successfully!');
                            window.location.reload(); // Reload the page to reflect the deletion
                        } else {
                            alert('Error deleting user!');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error deleting user!');
                    });
            }
                    
    };
    */
</script>

<div x-data="bookFilter()" class="flex flex-col items-center mx-auto p-4">
    <!-- Search Bar -->
    <input
        type="text"
        x-model="search"
        placeholder="Search title..."
        class="search-bar p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />

    <!-- Scrollable book list -->
    <div class="scrollable mt-4 max-h-72 overflow-y-auto border border-gray-300 rounded-lg p-2">
        <div class="headers grid grid-cols-6 gap-4 p-2 rounded-lg shadow-sm mb-1">
            <div></div>
            <div>Otsikko</div>
            <div>Kirjailija</div>
            <div>Genre</div>
            <div>Lisäyspäivä</div>
            <div>Asetukset</div>
        </div>
        <template x-for="(book, index) in filteredBooks()" :key="book.id">
            <div class="grid grid-cols-6 gap-4 justify-between items-center content-center p-2 rounded-lg shadow-sm mb-1">

                <!-- Book cover -->
                <div>
                    <img :src="`/images/covers/${book.cover}`" />
                </div>

                <!-- Book title (Click-to-Edit) -->
                <div x-data="{ isEditing: false, tempTitle: book.title }">
                    <span x-show="!isEditing" x-text="book.title" class="text-sm font-semibold cursor-pointer"
                        @click="isEditing = true; tempTitle = book.title;"></span>
                    <input
                        x-show="isEditing"
                        x-model="tempTitle"
                        type="text"
                        class="text-sm p-1 border rounded focus:ring focus:ring-blue-500"
                        @keyup.enter="book.title = tempTitle; isEditing = false"
                        @keyup.escape="isEditing = false"
                        x-ref="editInput"
                        x-effect="isEditing && $nextTick(() => $refs.editInput.focus())" />

                    <button x-show="isEditing" @click="book.title = tempTitle; isEditing = false" class="ml-2 text-blue-500">Save</button>
                    <button x-show="isEditing" @click="isEditing = false" class="ml-2 text-red-500">Cancel</button>
                </div>

                <!-- Book authors -->
                <div x-data="{ isEditing: false, tempAuthors: book.author_full_name }">
                    <span x-show="!isEditing" x-text="book.author_full_name" class="text-sm font-semibold cursor-pointer"
                        @click="isEditing = true; tempAuthors = book.author_full_name;"></span>
                    <input
                        x-show="isEditing"
                        x-model="tempAuthors"
                        type="text"
                        class="text-sm p-1 border rounded focus:ring focus:ring-blue-500"
                        @keyup.enter="book.author_full_name = tempAuthors; isEditing = false"
                        @keyup.escape="isEditing = false"
                        x-ref="editInput"
                        x-effect="isEditing && $nextTick(() => $refs.editInput.focus())" />

                    <button x-show="isEditing" @click="book.author_full_name = tempAuthors; isEditing = false" class="ml-2 text-blue-500">Save</button>
                    <button x-show="isEditing" @click="isEditing = false" class="ml-2 text-red-500">Cancel</button>
                </div>

                <!-- Book genre -->
                <div x-data="{ isEditing: false, tempGenres: book.genre_names }">
                    <span x-show="!isEditing" x-text="book.genre_names" class="text-sm font-semibold cursor-pointer"
                        @click="isEditing = true; tempGenres = book.genre_names;"></span>
                    <input
                        x-show="isEditing"
                        x-model="tempGenres"
                        type="text"
                        class="text-sm p-1 border rounded focus:ring focus:ring-blue-500"
                        @keyup.enter="book.genre_names = tempGenres; isEditing = false"
                        @keyup.escape="isEditing = false"
                        x-ref="editInput"
                        x-effect="isEditing && $nextTick(() => $refs.editInput.focus())" />

                    <button x-show="isEditing" @click="book.genre_names = tempGenres; isEditing = false" class="ml-2 text-blue-500">Save</button>
                    <button x-show="isEditing" @click="isEditing = false" class="ml-2 text-red-500">Cancel</button>
                </div>

                <!-- Creation date -->
                <div x-data="{
                    formattedDate: new Date(book.created_at).toLocaleDateString('fi-FI', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    })
                }">
                    <span x-text="formattedDate"></span>
                </div>


                <!-- Delete book -->
                <button @click="deleteUser(user)" class="text-sm text-red-600 hover:underline">Delete</button>

            </div>
        </template>
    </div>
</div>
<h3 class="section-title">Genres</h3>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('genreFilter', () => ({
            search: '',
            genres: @json($genres),

            filteredGenres() {
                return this.genres.filter(genre =>
                    genre.name.toLowerCase().includes(this.search.toLowerCase())
                );
            },

        }));

        Alpine.data('genreForm', () => ({
            newGenre: '',

            addGenre(name) {
                if (!name.trim()) {
                    alert("Please enter a genre name!");
                    return;
                }

                alert(`Genre added (not yet on the database though): ${name}`);

                // Reset input after adding
                this.newGenre = '';
            }
        }));
    });

    function updateGenre(genre) {
        alert(`Genre updated (not yet on the database though) ${genre.name}`);
    };

    function addGenre(genreName) {
        alert(`Genre added (not yet on the database though) ${genreName}`);
    };

    function deleteGenre(genre) {
        alert(`Genre deleted (not yet on the database though) ${genre.name} (ID: ${genre.id})`);
    };
</script>

<div x-data="genreFilter()" class="max-w-lg mx-auto p-4">
    <!-- Search Bar -->
    <input
        type="text"
        x-model="search"
        placeholder="Search genres..."
        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />

    <!-- Scrollable genre list -->
    <div class="mt-4 max-h-60 overflow-y-auto border border-gray-300 rounded-lg p-2">
        <template x-for="(genre, index) in filteredGenres()" :key="genre.id">
            <div class="flex justify-between items-center p-2 bg-gray-100 rounded-lg shadow-sm mb-1">

                <!-- Genre Name (Click-to-Edit) -->
                <div x-data="{ isEditing: false, tempName: genre.name }">
                    <span x-show="!isEditing" x-text="genre.name" class="text-sm font-semibold cursor-pointer"
                        @click="isEditing = true; tempName = genre.name;"></span>
                    <input
                        x-show="isEditing"
                        x-model="tempName"
                        type="text"
                        class="text-sm p-1 border rounded focus:ring focus:ring-blue-500"
                        @keyup.enter="genre.name = tempName; isEditing = false; $dispatch('update-genre', genre)"
                        @keyup.escape="isEditing = false"
                        x-ref="editInput"
                        x-effect="isEditing && $nextTick(() => $refs.editInput.focus())" />

                    <button x-show="isEditing" @click="genre.name = tempName; isEditing = false; updateGenre(genre);" class="ml-2 text-blue-500">Save</button>
                    <button x-show="isEditing" @click="isEditing = false" class="ml-2 text-red-500">Cancel</button>
                </div>

                <!-- Delete genre -->
                <button @click="deleteGenre(genre)" class="text-sm text-red-600 hover:underline">Delete</button>

            </div>
        </template>
    </div>
</div>
<!-- Add genre -->
<form x-data="{ newGenre: '' }" class="grid max-w-[50%] ml-10">
    <label>Add new genre:</label>
    <input type="text" id="genreName" name="genreName" x-model="newGenre"
        class="cursor-text placeholder:text-zinc-100 placeholder:italic mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-zinc-500 focus:ring focus:ring-zinc-500 focus:ring-opacity-50 cursor-pointer dark:bg-zinc-600 dark:hover:bg-zinc-700 dark:text-white"
        placeholder="Genre name" required>

    <button type="button" @click="addGenre(newGenre)"
        class="rounded-md py-2 px-3 bg-zinc-100 text-black hover:bg-zinc-200 dark:bg-zinc-600 dark:text-white dark:hover:bg-zinc-700">
        Save
    </button>
</form>
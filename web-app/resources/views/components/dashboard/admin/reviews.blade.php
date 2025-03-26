<h2>Reviews</h2>


<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('reviewFilter', () => ({
            search: '',
            reviews: @json($reviews),

            // TODO also filter on user
            filteredReviews() {
                return this.reviews.filter(review => ['content'].some(key =>
                    review[key]?.toLowerCase().includes(this.search.toLowerCase())
                ));
            },

        }));

    });

    function deleteReview(review) {
        if (confirm('Are you sure you want to delete this review? This action cannot be undone.')) {
            fetch(`/delete-review/${review.id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Review deleted successfully!');
                        window.location.reload(); // Reload the page to reflect the deletion
                    } else {
                        alert('Error deleting review!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting review!');
                });
        }
    };
</script>

<div x-data="reviewFilter()" class="flex flex-col items-center mx-auto p-4">
    <!-- Search Bar -->
    <input
        type="text"
        x-model="search"
        placeholder="Search review content..."
        class="search-bar p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />

    <!-- Scrollable review list -->
    <div class="scrollable mt-4 max-h-72 overflow-y-auto border border-gray-300 rounded-lg p-2">
        <div class="headers grid grid-cols-6 gap-4 p-2 rounded-lg shadow-sm mb-1">
            <div>Review</div>
            <div>Username</div>
            <div>Book name</div>
            <div>Note</div>
            <div>Recommend</div>
            <div></div>
        </div>
        <template x-for="(review, index) in filteredReviews()" :key="review.id">

            <div class=" grid grid-cols-6 gap-4 justify-between items-center content-center p-2 rounded-lg shadow-sm mb-1">
                <!-- Content -->
                <div>
                    <p x-text="review.content"></p>
                </div>

                <!-- Username -->
                <div>
                    <span x-text="review.user ? review.user.username : 'Deleted user'"></span>
                </div>


                <!-- Book name -->
                <div>
                    <span x-text="review.book ? review.book.title : 'Unknown Book'"></span>
                </div>

                <!-- Note -->
                <div>
                    <span x-text="review.note"></span>
                </div>

                <!-- Recommend -->
                <div>
                    <span x-text="review.recommend === 1 ? 'Suositeltu' : 'Ei suositeltu'"></span>
                </div>


                <!-- Delete review -->
                <button @click="deleteReview(review)" class="text-sm text-red-600 hover:underline">Delete</button>

            </div>
        </template>
    </div>
</div>
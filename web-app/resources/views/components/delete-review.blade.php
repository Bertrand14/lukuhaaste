<div x-data="{ deleteConfirmation: false }">

    <!-- Delete button -->
    <button @click="deleteConfirmation = true" class="delete-review">
        <i class="fa fa-solid fa-trash"></i>
        Delete
    </button>

    <!-- Confirm deletion popup (modal) -->
    <div x-show="deleteConfirmation"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="fixed inset-0 flex items-center justify-center z-50 bg-gray-500 bg-opacity-50"
        style="display: none;">

        <!-- Modal Content -->
        <div class="modal p-6 shadow-lg w-80">
            <h3>Are you sure you want to delete this review?</h3>

            <!-- Action buttons inside the modal -->
            <div class="flex justify-between">
                <button @click="$refs.deleteForm.submit()" class="btn btn-danger">Yes, delete</button>
                <button @click="deleteConfirmation = false" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Form (hidden) -->
    <form x-ref="deleteForm" action="{{ route('review.delete', $review->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>
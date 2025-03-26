<h2>Haasteet</h2>

<div class="buttons">
    <a href="{{ route('new-event') }}">Suunnitele uuden haasteen</a>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('eventFilter', () => ({
            search: '',
            events: @json($events),

            filteredEvents() {
                return this.events.filter(events => ['name', 'description'].some(key =>
                    events[key]?.toLowerCase().includes(this.search.toLowerCase())
                ));
            },

        }));

    });

    function deleteEvent(event) {
        if (confirm('Are you sure you want to delete this event? This action cannot be undone.')) {
            fetch(`/event/${event.id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Event deleted successfully!');
                        window.location.reload(); // Reload the page to reflect the deletion
                    } else {
                        alert('Error deleting event!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting event!');
                });
        }
    };
</script>

<div x-data="eventFilter()" class="flex flex-col items-center mx-auto p-4">
    <!-- Search Bar -->
    <input
        type="text"
        x-model="search"
        placeholder="Search event..."
        class="search-bar p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />

    <!-- Scrollable event list -->
    <div class="scrollable mt-4 max-h-72 overflow-y-auto border border-gray-300 rounded-lg p-2">
        <div class="headers grid grid-cols-6 gap-4 p-2 rounded-lg shadow-sm mb-1">
            <div>Name</div>
            <div>Description</div>
            <div>Start</div>
            <div>End</div>
            <div>Lisäyspäivä</div>
            <div>Asetukset</div>
        </div>
        <template x-for="(event, index) in filteredEvents()" :key="event.id">

            <div class=" grid grid-cols-6 gap-4 justify-between items-center content-center p-2 rounded-lg shadow-sm mb-1">
                <!-- Name -->
                <div>
                    <p x-text="event.name"></p>
                </div>

                <!-- Description -->
                <div>
                    <p x-text="event.description"></p>
                </div>

                <!-- Start date -->
                <div x-data="{
                    startDate: new Date(event.startDate).toLocaleDateString('fi-FI', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    })
                }">
                    <span x-text="startDate"></span>
                </div>

                <!-- End date -->
                <div x-data="{
                    endDate: new Date(event.endDate).toLocaleDateString('fi-FI', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    })
                }">
                    <span x-text="endDate"></span>
                </div>

                <!-- Creation date -->
                <div x-data="{
                    creationDate: new Date(event.created_at).toLocaleDateString('fi-FI', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    })
                }">
                    <span x-text="creationDate"></span>
                </div>


                <!-- Delete review -->
                <button @click="deleteEvent(event)" class="text-sm text-red-600 hover:underline">Delete</button>

            </div>
        </template>
    </div>
</div>
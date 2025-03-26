<h3 class="section-title">Challenges</h3>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('eventFilter', () => ({
            search: '',
            filterType: 'all',
            events: @json($events),

            filteredEvents() {
                let today = new Date().toISOString().split('T')[0];

                return this.events
                    .filter(event =>
                        event.name.toLowerCase().includes(this.search.toLowerCase())
                    )
                    .filter(event => {
                        if (this.filterType === 'past') {
                            return event.endDate < today;
                        } else if (this.filterType === 'current') {
                            return event.startDate <= today && event.endDate >= today;
                        } else if (this.filterType === 'upcoming') {
                            return event.startDate > today;
                        }
                        return true;
                    });
            },
        }));

        Alpine.data('eventForm', () => ({
            newEvent: '',
            addEvent(name) {
                if (!name.trim()) {
                    alert("Please enter an event name!");
                    return;
                }
                alert(`Event added (not yet on the database though): "${name}"`);
                this.newEvent = '';
            }
        }));
    });

    function deleteEvent(event) {
        alert(`Will delete the event (not yet on the database though) "${event.name}" (ID: ${event.id})`);
    };

    function editEvent(event) {
        alert(`Will redirect to a form to edit the event "${event.name}" (ID: ${event.id})`);
    };
</script>

<div x-data="eventFilter()" class="mx-auto p-4">
    <!-- Search bar -->
    <input
        type="text"
        x-model="search"
        placeholder="Search events..."
        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />

    <!-- Filter buttons -->
    <div class="mt-2 flex gap-2">
        <button @click="filterType = 'all'"
            class="px-3 py-1 text-sm rounded-lg"
            :class="filterType === 'all' ? 'bg-blue-500 text-white' : 'bg-gray-200'">
            All
        </button>
        <button @click="filterType = 'past'"
            class="px-3 py-1 text-sm rounded-lg"
            :class="filterType === 'past' ? 'bg-blue-500 text-white' : 'bg-gray-200'">
            Past Challenges
        </button>
        <button @click="filterType = 'current'"
            class="px-3 py-1 text-sm rounded-lg"
            :class="filterType === 'current' ? 'bg-blue-500 text-white' : 'bg-gray-200'">
            Current Challenges
        </button>
        <button @click="filterType = 'upcoming'"
            class="px-3 py-1 text-sm rounded-lg"
            :class="filterType === 'upcoming' ? 'bg-blue-500 text-white' : 'bg-gray-200'">
            Upcoming Challenges
        </button>
    </div>

    <!-- Scrollable event list -->
    <div class="mt-4 max-h-80 overflow-y-auto border border-gray-300 rounded-lg p-2">
        <template x-for="(event, index) in filteredEvents()" :key="event.id">
            <div class="flex justify-between items-center p-2 gap-5 bg-gray-100 rounded-lg shadow-sm mb-1">
                <div>
                    <div>
                        <span x-text="event.name" class="text-sm font-semibold"></span>
                    </div>
                    <div>
                        <span x-text="'Starts on: ' + event.startDate" class="text-sm"></span>
                    </div>
                    <div>
                        <span x-text="'Ends on: ' + event.endDate" class="text-sm"></span>
                    </div>
                    <div>
                        <span x-text="event.description" class="text-sm"></span>
                    </div>
                </div>

                <!-- Edit event -->
                <button @click="editEvent(event)" class="text-sm text-blue-600 hover:underline">Edit</button>
                <!-- Delete event -->
                <button @click="deleteEvent(event)" class="text-sm text-red-600 hover:underline">Delete</button>
            </div>
        </template>
    </div>
</div>
<!-- Add event -->
<h3>Add new challenge:</h3>
<form method="POST" action="{{ route('event.store') }}" class="grid max-w-[50%] ml-10">
    @csrf <!-- CSRF token for security -->

    <label for="challengeName">Challenge Name:</label>
    <input type="text" id="challengeName" name="name" class="cursor-text placeholder:text-zinc-100 placeholder:italic mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-zinc-500 focus:ring focus:ring-zinc-500 focus:ring-opacity-50 cursor-pointer dark:bg-zinc-600 dark:hover:bg-zinc-700 dark:text-white" placeholder="Challenge name" required>

    <label for="startDate" class="mt-2">Start Date:</label>
    <input type="date" id="startDate" name="start_date" class="cursor-text placeholder:text-zinc-100 placeholder:italic mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-zinc-500 focus:ring focus:ring-zinc-500 focus:ring-opacity-50 cursor-pointer dark:bg-zinc-600 dark:hover:bg-zinc-700 dark:text-white" required>

    <label for="endDate" class="mt-2">End Date:</label>
    <input type="date" id="endDate" name="end_date" class="cursor-text placeholder:text-zinc-100 placeholder:italic mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-zinc-500 focus:ring focus:ring-zinc-500 focus:ring-opacity-50 cursor-pointer dark:bg-zinc-600 dark:hover:bg-zinc-700 dark:text-white" required>

    <label for="description" class="mt-2">Description:</label>
    <textarea id="description" name="description" class="cursor-text placeholder:text-zinc-100 placeholder:italic mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-zinc-500 focus:ring focus:ring-zinc-500 focus:ring-opacity-50 cursor-pointer dark:bg-zinc-600 dark:hover:bg-zinc-700 dark:text-white" placeholder="Describe the challenge..." value="description of the challenge" required></textarea>

    <button type="submit" class="rounded-md py-2 px-3 bg-zinc-100 text-black hover:bg-zinc-200 dark:bg-zinc-600 dark:text-white dark:hover:bg-zinc-700 mt-4">
        Add Challenge
    </button>
</form>
<h2>Käyttäjät</h2>


<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('userRole', (userId, initialRole) => ({
            role: initialRole,
            roles: @json($userTypes ?? []),
            async changeRole() {

                let currentIndex = this.roles.findIndex(role => role.name_type === this.role);
                let nextRole = this.roles[(currentIndex + 1) % this.roles.length];

                let response = await fetch(`/update-role/${userId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        roleId: nextRole.id
                    })
                });

                if (response.ok) {
                    this.role = nextRole.name_type;
                } else {
                    console.error("Erreur lors de la mise à jour du rôle");
                }
            }
        }));
    });

    document.addEventListener('alpine:init', () => {
        Alpine.data('userFilter', () => ({
            search: '',
            users: @json($users),

            filteredUsers() {
                return this.users.filter(user => ['first_name', 'last_name', 'username', 'email', 'address'].some(key =>
                    user[key]?.toLowerCase().includes(this.search.toLowerCase())
                ));
            },

        }));

    });

    function updateUsername(user, username) {
        fetch(`/user/${user.id}`)
            .then(response => response.json())
            .then(data => {
                user.username = username;
                updateUser(user);
            })
            .catch(error => {
                console.error('Error fetching user info:', error);
                alert('Error fetching user information!');
            });
    }

    function updateUserFirstname(user, first_name) {
        fetch(`/user/${user.id}`)
            .then(response => response.json())
            .then(data => {
                user.first_name = first_name;
                updateUser(user);
            })
            .catch(error => {
                console.error('Error fetching user info:', error);
                alert('Error fetching user information!');
            });
    }

    function updateUserLastname(user, last_name) {
        fetch(`/user/${user.id}`)
            .then(response => response.json())
            .then(data => {
                user.last_name = last_name;
                updateUser(user);
            })
            .catch(error => {
                console.error('Error fetching user info:', error);
                alert('Error fetching user information!');
            });
    }

    function updateUserEmail(user, email) {
        fetch(`/user/${user.id}`)
            .then(response => response.json())
            .then(data => {
                user.email = email;
                updateUser(user);
            })
            .catch(error => {
                console.error('Error fetching user info:', error);
                alert('Error fetching user information!');
            });
    }

    function updateUserAddress(user, address) {
        fetch(`/user/${user.id}`)
            .then(response => response.json())
            .then(data => {
                user.address = address;
                updateUser(user);
            })
            .catch(error => {
                console.error('Error fetching user info:', error);
                alert('Error fetching user information!');
            });
    }

    function updateUser(user) {
        fetch(`/update-user/${user.id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    username: user.username,
                    first_name: user.first_name,
                    last_name: user.last_name,
                    email: user.email,
                    address: user.address
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the user object with new values
                    user.username = data.username;
                    user.first_name = data.first_name;
                    user.last_name = data.last_name;
                    user.email = data.email;
                    user.address = data.address;
                    alert('User details updated successfully!');
                } else {
                    alert('Error updating user details!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating user details!');
            });
    }


    function deleteUser(user) {
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
</script>

<div x-data="userFilter()" class="flex flex-col items-center mx-auto p-4">
    <!-- Search Bar -->
    <input
        type="text"
        x-model="search"
        placeholder="Search usernames, email, address..."
        class="search-bar p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />

    <!-- Scrollable user list -->
    <div class="mt-4 max-h-72 overflow-y-auto border border-gray-300 rounded-lg p-2">
        <div class="headers grid grid-cols-7 gap-4 p-2 rounded-lg shadow-sm mb-1">
            <div>Username</div>
            <div>First name</div>
            <div>Last name</div>
            <div>Mail</div>
            <div>Address</div>
            <div>Role</div>
            <div></div>
        </div>
        <template x-for="(user, index) in filteredUsers()" :key="user.id">
            <div class="grid grid-cols-7 gap-4 justify-between items-center content-center p-2 rounded-lg shadow-sm mb-1">

                <!-- username (Click-to-Edit) -->
                <div x-data="{ isEditing: false, tempUsername: user.username }">
                    <span x-show="!isEditing" x-text="user.username" class="text-sm font-semibold cursor-pointer"
                        @click="isEditing = true; tempUsername = user.username;"></span>
                    <input
                        x-show="isEditing"
                        x-model="tempUsername"
                        type="text"
                        class="text-sm p-1 border rounded focus:ring focus:ring-blue-500"
                        @keyup.enter="user.username = tempUsername; isEditing = false; updateUsername(user, tempUsername)"
                        @keyup.escape="isEditing = false"
                        x-ref="editInput"
                        x-effect="isEditing && $nextTick(() => $refs.editInput.focus())" />

                    <button x-show="isEditing" @click="user.username = tempUsername; isEditing = false; updateUsername(user, tempUsername);" class="ml-2 text-blue-500">Save</button>
                    <button x-show="isEditing" @click="isEditing = false" class="ml-2 text-red-500">Cancel</button>
                </div>

                <!-- user first name (Click-to-Edit) -->
                <div x-data="{ isEditing: false, tempFirstname: user.first_name }">
                    <span x-show="!isEditing" x-text="user.first_name" class="text-sm font-semibold cursor-pointer"
                        @click="isEditing = true; tempFirstname = user.first_name;"></span>
                    <input
                        x-show="isEditing"
                        x-model="tempFirstname"
                        type="text"
                        class="text-sm p-1 border rounded focus:ring focus:ring-blue-500"
                        @keyup.enter="user.first_name = tempFirstname; isEditing = false; updateUserFirstname(user, tempFirstname)"
                        @keyup.escape="isEditing = false"
                        x-ref="editInput"
                        x-effect="isEditing && $nextTick(() => $refs.editInput.focus())" />

                    <button x-show="isEditing" @click="user.first_name = tempFirstname; isEditing = false; updateUserFirstname(user, tempFirstname);" class="ml-2 text-blue-500">Save</button>
                    <button x-show="isEditing" @click="isEditing = false" class="ml-2 text-red-500">Cancel</button>
                </div>

                <!-- user last name (Click-to-Edit) -->
                <div x-data="{ isEditing: false, tempLastname: user.last_name }">
                    <span x-show="!isEditing" x-text="user.last_name" class="text-sm font-semibold cursor-pointer"
                        @click="isEditing = true; tempLastname = user.last_name;"></span>
                    <input
                        x-show="isEditing"
                        x-model="tempLastname"
                        type="text"
                        class="text-sm p-1 border rounded focus:ring focus:ring-blue-500"
                        @keyup.enter="user.last_name = tempLastname; isEditing = false; updateUserLastname(user, tempLastname)"
                        @keyup.escape="isEditing = false"
                        x-ref="editInput"
                        x-effect="isEditing && $nextTick(() => $refs.editInput.focus())" />

                    <button x-show="isEditing" @click="user.last_name = tempLastname; isEditing = false; updateUserLastname(user, tempLastname);" class="ml-2 text-blue-500">Save</button>
                    <button x-show="isEditing" @click="isEditing = false" class="ml-2 text-red-500">Cancel</button>
                </div>

                <!-- user email (Click-to-Edit) -->
                <div x-data="{ isEditing: false, tempEmail: user.email }">
                    <span x-show="!isEditing" x-text="user.email" class="text-sm font-semibold cursor-pointer"
                        @click="isEditing = true; tempEmail = user.email;"></span>
                    <input
                        x-show="isEditing"
                        x-model="tempEmail"
                        type="text"
                        class="text-sm p-1 border rounded focus:ring focus:ring-blue-500"
                        @keyup.enter="user.email = tempEmail; isEditing = false; updateUserEmail(user, tempEmail)"
                        @keyup.escape="isEditing = false"
                        x-ref="editInput"
                        x-effect="isEditing && $nextTick(() => $refs.editInput.focus())" />

                    <button x-show="isEditing" @click="user.email = tempEmail; isEditing = false; updateUserEmail(user, tempEmail);" class="ml-2 text-blue-500">Save</button>
                    <button x-show="isEditing" @click="isEditing = false" class="ml-2 text-red-500">Cancel</button>
                </div>

                <!-- user address (Click-to-Edit) -->
                <div x-data="{ isEditing: false, tempAddress: user.address }">
                    <span x-show="!isEditing" x-text="user.address" class="text-sm font-semibold cursor-pointer"
                        @click="isEditing = true; tempAddress = user.address;"></span>
                    <input
                        x-show="isEditing"
                        x-model="tempAddress"
                        type="text"
                        class="text-sm p-1 border rounded focus:ring focus:ring-blue-500"
                        @keyup.enter="user.address = tempAddress; isEditing = false; updateUserAddress(user, tempAddress)"
                        @keyup.escape="isEditing = false"
                        x-ref="editInput"
                        x-effect="isEditing && $nextTick(() => $refs.editInput.focus())" />

                    <button x-show="isEditing" @click="user.address = tempAddress; isEditing = false; updateUserAddress(user, tempAddress);" class="ml-2 text-blue-500">Save</button>
                    <button x-show="isEditing" @click="isEditing = false" class="ml-2 text-red-500">Cancel</button>
                </div>

                <!-- user role (button) -->
                <div x-data="userRole(user.id, user.right_name)" class="flex items-center space-x-2">
                    <span x-text="role"
                        class="role text-sm font-semibold"
                        :class="role === 'admin' ? 'text-green-600' : 'text-gray-600'">
                    </span>

                    <button @click="changeRole()"
                        class="px-2 py-1 text-white text-xs rounded bg-blue-500 hover:bg-blue-600"
                        x-text="role === 'admin' ? 'Set as Member' : 'Set as Admin'">
                    </button>

                </div>

                <!-- Delete user -->
                <button @click="deleteUser(user)" class="text-sm text-red-600 hover:underline">Delete</button>

            </div>
        </template>
    </div>
</div>
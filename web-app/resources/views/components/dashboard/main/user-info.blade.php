<h3 class="section-title">Tiedot</h3>

<!-- View details (default visible) -->
<div x-show="!editMode" x-cloak>
    <x-dashboard.main.account-info :user="$user" />
</div>

<!-- Edit details (default hidden) -->
<div x-show="editMode" x-cloak>
    <x-dashboard.main.account-info-update :user="$user" />
</div>

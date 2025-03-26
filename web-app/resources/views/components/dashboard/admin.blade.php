<section x-show="UserInfos" x-data="{ editMode: false }" class="half-width userInfos" x-cloak>
  <x-dashboard.main.user-info x-show="UserInfos" :user="$user" />
</section>

<!-- ADMIN ACTIONS -->
<section x-show="AdminActions" class="actionsList" x-cloak>
  <x-dashboard.admin.actions />
</section>

<!-- ADMIN USERS -->
<section x-show="AdminUsers" class="usersList" x-cloak>
  <x-dashboard.admin.users :users="$users" :userTypes="$userTypes" />
</section>

<!-- ADMIN BOOKS -->
<section x-show="AdminBooks" class="booksList" x-cloak>
  <x-dashboard.admin.books :books="$books" />
</section>

<!-- ADMIN EVENTS -->
<section x-show="AdminEvents" class="eventsList" x-cloak>
  <x-dashboard.admin.events :events="$events" />
</section>

<!-- ADMIN REVIEWS -->
<section x-show="AdminReviews" class="reviewsList" x-cloak>
  <x-dashboard.admin.reviews :reviews="$reviews" />
</section>

<div x-show="Alpine.store('popUpDelete').popUpDelete" x-transition class="popUpDelete" x-cloak>
  <x-dashboard.admin.sheet-delete />
</div>

<script>
  document.addEventListener('alpine:init', () => {
    Alpine.store('popUpDelete', {
      popUpDelete: false,
      item: null,
      tableName: null, // On initialise la table vide
      openPopup(item, table) {
        this.item = item;
        this.tableName = table; // On assigne la table transmise
        this.popUpDelete = true;
      },
      closePopup() {
        this.popUpDelete = false;
        this.item = null;
        this.tableName = null; // On réinitialise
      }
    });
  });
</script>
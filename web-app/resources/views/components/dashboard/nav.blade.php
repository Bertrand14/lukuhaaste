<nav id="dashboard-nav">
    <a @click="UserInfos = true; AdminUsers = false; AdminBooks = false; AdminEvents = false;  AdminReviews=false; ProgressBar = false; DangerZone = true;"
        class="userInfos">
        Tietoni
    </a>
    @if (auth()->check())
    @if (auth()->user()->isAdmin()) <!-- Admin view only -->
    <a @click="UserInfos = false; AdminUsers = true; AdminBooks = false; AdminEvents = false; AdminReviews=false"
        class="usersList">
        Käyttäjät
    </a>
    <a @click="UserInfos = false; AdminUsers = false; AdminBooks = true; AdminEvents = false; AdminReviews=false"
        class="booksList">
        Kirjat
    </a>
    <a @click="UserInfos = false; AdminUsers = false; AdminBooks = false; AdminEvents = true; AdminReviews=false"
        class="eventsList">
        Haasteet
    </a>
    <a @click="UserInfos = false; AdminUsers = false; AdminBooks = false; AdminEvents = false; AdminReviews=true"
        class="eventsList">
        Arvostelut
    </a>
    @else
    <a @click="UserInfos = false; ProgressBar = true;"
        class="eventsList">
        Edistymistäni
    </a>
    @endif
    @endif
</nav>
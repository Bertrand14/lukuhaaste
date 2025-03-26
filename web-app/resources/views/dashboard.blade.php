<x-app-layout>
    <div x-data="{ 
        UserInfos: true,
        HideAll: false, 
        AdminUsers: false, 
        AdminBooks: false, 
        AdminEvents: false, 
        AdminReviews: false,
        popUpDelete: false,
        AdminActions: false,
        ProgressBar: false,
        DangerZone: true,
        item: null, 
        tableName: '' 
    }">
        <x-dashboard.nav />

        @if (auth()->check())
        @php
        $hour = date('H');
        if ($hour >= 5 && $hour < 11) {
            $greeting='Hyvää huomenta' ;
            } elseif ($hour>= 11 && $hour < 18) {
                $greeting='Hyvää päivää' ;
                } elseif ($hour>= 18 && $hour < 23) {
                    $greeting='Hyvää iltaa' ;
                    } else {
                    $greeting='Hyvää yötä' ;
                    }
                    @endphp

                    <div class="dashboard">
                    <h2 class="">{{ $greeting }}, {{ $user->username }} !</h2>
                    @if (auth()->user()->isAdmin())
                    <x-dashboard.admin :user="$user" :users="$users" :books="$books" :events="$events" :reviews="$reviews" :userTypes="$userTypes" />
                    @else
                    <x-dashboard.member :user="$user" />
                    @endif
    </div>
    @endif
    </div>
</x-app-layout>
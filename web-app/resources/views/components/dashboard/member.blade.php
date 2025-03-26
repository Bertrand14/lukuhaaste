<!--
if the member is registered for an event -> display the progress bar
else
1) if an event is in progress, set up a button for him to participate
2) otherwise display a text "No event currently"
-->
<!-- Progress bar -->

<section x-show="UserInfos" x-data="{ editMode: false }" class="userInfos half-width" x-cloak>
    <x-dashboard.main.user-info x-show="UserInfos" :user="$user" />
</section>

<section x-show="ProgressBar" class="progressBar">
    <x-dashboard.member.progress-bar :user="$user" />
</section>

<!-- Danger zone -->
<section x-show="DangerZone" class="dangerZone">
    <x-dashboard.member.danger-zone :user="$user" />
</section>
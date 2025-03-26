@php 
$infoList = [
    ["Pseudo", $user->username],
    ["Etunimi", $user->first_name],
    ["Sukunimi", $user->last_name],
    ["Yksikkö", $user->address],
    ["S-posti", $user->email]
];
@endphp

<div class="user-info">
@foreach ($infoList as $info)
    <span class="label">{{ $info[0] }}:</span>
    <span class="value">{{ $info[1] }}</span>
@endforeach
</div>

<button
    @click="editMode = true"
    class="update-button">
    <i class="fas fa-edit"></i>
    Muokkaa tietoja
</button>
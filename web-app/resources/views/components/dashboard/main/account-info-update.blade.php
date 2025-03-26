@php
$infoList = [
["Pseudo", $user->username],
["Etunimi", $user->first_name],
["Sukunimi", $user->last_name],
["Yksikkö", $user->address],
["S-posti", $user->email]
];
@endphp

<form method="POST" action="{{ route('account.update') }}">
    @csrf
    @method('PUT')
    <div class="user-info">
        @foreach ($infoList as $key => $info)
        <label for="{{ $key }}" class="label">{{ $info[0] }}:</label>
        <input type="text" id="{{ $key }}" name="{{ strtolower(str_replace(' ', '_', $info[0])) }}" value="{{ old(strtolower(str_replace(' ', '_', $info[0])), $info[1]) }}">
        @endforeach
    </div>
    <div class="buttons">
        <a
            @click="editMode = false"
            class="button">
            <i class="fas fa-times"></i>
            Peruuta
        </a>
        <button type="submit" class="save-button">
            <i class="fas fa-save"></i>
            Tallenna
        </button>
    </div>
</form>
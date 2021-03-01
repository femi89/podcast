@php $editing = isset($guest) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-md-12 col-lg-12">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $guest->name : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-md-12 col-lg-12">
        <x-inputs.email
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? $guest->email : '')) }}"
            maxlength="255"
        ></x-inputs.email>
    </x-inputs.group>
</div>

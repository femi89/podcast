@php $editing = isset($podcast) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-md-12 col-lg-12">
        <x-inputs.select name="album_id" label="Album Id">
            @php $selected = old('album_id', ($editing ? $podcast->album_id : '')) @endphp
            @foreach($albums as $album)
                <option value="{{$album->id}}">{{$album->name}}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-md-12 col-lg-12">
        <x-inputs.text
            name="title"
            label="Title"
            value="{{ old('title', ($editing ? $podcast->title : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-md-12 col-lg-12">
       <x-inputs.text
            name="audio_url"
            label="Audio Url"
            value="{{ old('audio_url', ($editing ? $podcast->audio_url : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-md-12 col-lg-12">
        <x-inputs.text
            name="size"
            label="Size"
            value="{{ old('size', ($editing ? $podcast->size : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>
</div>

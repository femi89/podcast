@php $editing = isset($like) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-md-12 col-lg-12">
        <x-inputs.select name="podcast_id" label="Podcast" required>
            @php $selected = old('podcast_id', ($editing ? $like->podcast_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Podcast</option>
            @foreach($podcasts as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-md-12 col-lg-12">
        <x-inputs.select name="guest_id" label="Guest" required>
            @php $selected = old('guest_id', ($editing ? $like->guest_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Guest</option>
            @foreach($guests as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>

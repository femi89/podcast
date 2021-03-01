@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('podcasts.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.podcasts.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.podcasts.inputs.album_id')</h5>
                    <span>{{ $podcast->album_id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.podcasts.inputs.title')</h5>
                    <span>{{ $podcast->title ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.podcasts.inputs.audio_url')</h5>
                    <span>{{ $podcast->audio_url ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.podcasts.inputs.size')</h5>
                    <span>{{ $podcast->size ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('podcasts.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Podcast::class)
                <a href="{{ route('podcasts.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection

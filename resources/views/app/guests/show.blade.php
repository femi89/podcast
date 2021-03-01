@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('guests.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.guests.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.guests.inputs.name')</h5>
                    <span>{{ $guest->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.guests.inputs.email')</h5>
                    <span>{{ $guest->email ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('guests.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Guest::class)
                <a href="{{ route('guests.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@php $editing = isset($podcast) @endphp
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('podcasts.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.podcasts.create_title')
            </h4>
            @if($errors->any())
             @foreach($errors->all() as  $error)
                    <div class="alert alert-danger" role="alert">
                        <strong>{{$error}}</strong>
                    </div>
                @endforeach
             @endif
            <form class="px-4" method="post" action="{{ route('podcasts.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group"><label>Album</label>
                    <select class="form-control custom-select" name="album" required>
                        @php $selected = old('album', ($editing ? $podcast->album_id : '')) @endphp
                        @foreach($albums as $album)
                            <option value="{{$album->id}}">{{$album->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title', ($editing ? $podcast->title : '')) }}" maxlength="255" required/>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" name="description" value="{{ old('description', ($editing ? $podcast->description : '')) }}" maxlength="1000" required/>
                </div>
                <div class="form-group custom-file">
                    <input type="file" id="customFile" class="custom-file-input" accept="audio/*" required name="podcast_file" value="{{old('podcast_file')}}"/>
                    <label id="customFile" class="custom-file-label">Choose podcast file to upload</label>
                </div>

                <div class="py-4 text-center">
                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.create')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('js')
    <script src="{{asset("assets/js/jquery.min.js")}}"></script>
    <script type="text/javascript">
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection

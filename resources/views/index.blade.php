<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>podcast</title>
    <link rel="stylesheet" href="{{asset("assets/bootstrap/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/fonts/font-awesome.min.css")}}">
</head>

<body>
<main>
    <div class="container">
        <div class="py-3">
            <h3>Music files</h3>
            <p>Something nice</p>
        </div>
        <ul class="list-group">
            @if($podcasts->isEmpty())
                <div class="alert alert-danger" role="alert">
                    <strong>Podcast list is empty</strong>
                </div>
            @else
                @foreach($podcasts as $podcast)
                    <li class="list-group-item">
                        <div class="media">
                            <div class="media-body">
                                <h5>{{$podcast->title}}</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>{{humanReadable($podcast->size??0)}}</span>
                                    <a class="btn btn-primary btn-sm float-right" role="button" href="{{route('podcasts.show', $podcast->slug)}}">
                                        <i class="fa fa-play"></i>&nbsp;play</a>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach

            @endif
        </ul>
    </div>
</main>
<footer class="mt-5">
    <p class="mb-0 text-center">© 2020 podcast</p>
</footer>
<script src="{{asset("assets/js/jquery.min.js")}}"></script>
<script src="{{asset("assets/bootstrap/js/bootstrap.min.js")}}"></script>
</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Podcast</title>
    <link rel="stylesheet" href="{{asset("assets/bootstrap/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="{{asset("assets/fonts/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/styles.min.css")}}">
</head>

<body>
<div class="container">
    <div class="row justify-content-center h-100" style="min-height: 450px;">
        <div class="col-md-6 mt-4">
            <div class="card sticky-top">
              <div class="card-body">
                  <div class="radio-body" style="/*background-color: #4e2b46;*/">
                      <div class="row no-gutters justify-content-center align-items-center" style="height: calc(100% - 0px);">
                          <div class="col">
                              <div class="text-center"><img id="pStatus" src="{{asset("assets/img/disc.png")}}" style="width: 184px;"></div>
                              <div style="margin-top: 80px;">
                                  <div class="event-head">
                                      <h2>Title:<small> {{$podcast->title}}</small></h2>
                                      <h2>Album: <small>{{$podcast->album->name??'unspecify'}}</small></h2>
                                      <p>Description: {{$podcast->description}}</p>
                                      <p>size: {{humanReadable($podcast->size??0)}}</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="fixed-bottom" style="position: relative; padding: 5px;/*background-color: #e0ceda;*/border: 1px solid rgba(0, 0, 0, 0.1);-webkit-box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.02);box-shadow: 0px 3px 16px rgba(0, 0, 0, 0.02);">
                      <div></div>
                      <div id="audioplayer1" class="audioplayer">
                          <audio id="music1" controls="" preload="auto" autoplay allow="autoplay">
                              <source src="{{url($podcast->audio_url)}}" type="audio/mpeg"></audio>
                          <button class="btn btn-primary play-btn" id="pButton1" name="audioplay"></button>
                          <div class="player-timestamp"><span id="timeupdate1" class="timeupdate"></span>
                              <div id="timeline1" class="timeline">
                                  <div id="playhead1" class="playhead"></div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center pt-3">
                      <a class="btn btn-primary btn-sm" role="button" href="{{route('podcasts.like', $podcast->id)}}"><i class="fa fa-thumbs-o-up"></i> {{$podcast->likes->count()}}</a>
                      <button class="btn btn-info btn-sm ml-2" type="button"><i class="fa fa-wechat"></i> {{$podcast->comments->count()}}</button>
                  </div>
              </div>
            </div>
          </div>
        <div class="col-md-6">
            <div class="py-3">
                <h5>post a Comments</h5>
                @if($errors->any())
                @foreach($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            <strong>{{$error}}!</strong>
                        </div>
                    @endforeach
                @endif
                 @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{session()->get('success')}}</strong>
                    </div>
                 @endif
                <form method="post" action="{{route('comment.create')}}">
                    <input type="hidden" name="podcast_id" value="{{$podcast->id}}">
                    @csrf
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{old('name')??''}}"/></div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" value="{{old('email')??''}}"/></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><textarea class="form-control" name="message" required>{{old('message')??''}}</textarea></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Comment</button>
                    </div>
                </form>
                <div class="py-3 px-2 bg-info text-white">
                    <h4 class="mb-0 text-white">What people are saying about the music</h4>
                </div>
                <ul class="list-group">
                        @if($podcast->comments->isEmpty())
                        <li class="list-group-item">
                           <div class="alert alert-warning" role="alert">
                                <strong>No comment yet</strong>
                            </div>
                        </li>
                        @else
                            @foreach($podcast->comments as $comment)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center text-black-50">
                                    <span>{{$comment->name}}</span><span>{{$comment->created_at->diffForHumans()}}</span>
                                </div>
                                <p class="mb-0">{{$comment->message}}</p>
                            </li>
                            @endforeach
                        @endif

                </ul>
            </div>
        </div>
    </div>
</div>
<script src="{{asset("assets/js/jquery.min.js")}}"></script>
<script src="{{asset("assets/bootstrap/js/bootstrap.min.js")}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="{{asset("assets/js/script.min.js")}}"></script>

</body>

</html>

@extends('app')

@section('content')
<html>
<head>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </head>
  <body>
  <div class="container" id="testtest">

    <form class="form-horizontal" role="form" method="POST" action="/saveComment">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="col-md-6 col-md-offset-3">
      <h1>{{ $vefsida->title }}@if($user->username == $vefsida->hofundur)
        <a href="{{url('/Edit', $vefsida->id)}}">Edit</a>]
        <input type="hidden" name="post_name" value="{{ $vefsida->id }}">
        <input type="hidden" name="current_user" value="{{ $user->username }}">
      @else
      @endif</h1>
        <article>
          {{ $vefsida->body}}
        </article>

    </div>
    <h1 class="navabar-fixed-bottom col-md-6 col-md-offset-3">helgi</h1>
    <!--<div class=" navbar navbar-fixed-bottom col-md-offset-2" id="submit_myndir">
        <img src="../{{$user->profilephoto}}"  height="50" >
    </div>-->

      <div class=" navbar-fixed-bottom col-md-6 col-md-offset-3" id="comments">
        <label for="comment">Comment:</label>
        <textarea class="form-control" rows="5" cols="3" name="comment"></textarea>
        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
      </div>
    </form>
  </div>

  </body>
  </html>

</body>
@stop

@extends('app')

@section('hello')

      @foreach ($verktakar as $verktakar)

      @endforeach
      <div class="col-md-8">
            <h2 align="center"> TOP 3</h2><br></div>
      <div class="col-md-12" style='background: #e3e3e3;'>
      <div class="col-md-6" style="display: inline-block;">
        <ul class="nav">
                <li><h1>Verktakar</h1></li>

        @if(count($verktakar->all()) > 3)
            @for($i = 0;$i < 3;$i++)
            <li><h2>
            <a href="{{url('/verktakar',  $verktakar->all()[$i]->id)}}">{{ $verktakar->all()[$i]->title }}</a>
          </h2></li>
            @if(strlen($verktakar->all()[$i]->body) > 250) <li>{{
              substr($verktakar->all()[$i]->body,0,249) }}...</li>
            @else
            <li> {{$verktakar->all()[$i]->body}} </li>
            @endif
      @endfor
      @else
      @for($i = 0; $i < count($verktakar->all());$i++)
                <li><h2>
                  <a href="{{url('/verktakar',  $verktakar->all()[$i]->id)}}">{{ $verktakar->all()[$i]->title }}</a>
                </h2></li>
                  @if(strlen($verktakar->all()[$i]->body) > 250)<li> {{
                    substr($verktakar->all()[$i]->body,0,249) }}... </li>
                  @else
                  <li> {{$verktakar->all()[$i]->body}} </li>
                  @endif
          @endfor

      @endif
      </ul>

    </div>
      @foreach ($vefsida as $vefsida)

      @endforeach
      <div class="col-md-6" style="display: inline-block;">
      <ul class="nav">
              <li><h1>Vefsíður</h1></li>
      @if(count($vefsida->all()) > 3)
      @for($i = 0; $i < 3;$i++)
      <li><h2>
          <a href="{{url('/vefsida',  $vefsida->all()[$i]->id)}}">{{ $vefsida->all()[$i]->title }}</a>
        </h2></li>
          @if(strlen($vefsida->all()[$i]->body) > 250)<li>{{
          substr($vefsida->all()[$i]->body,0,249) }}...</li>
          @else
          <li>{{$vefsida->all()[$i]->body}}</li>
          @endif
    @endfor
    @else
    @for($i = 0; $i < count($vefsida->all());$i++)
              <li><h2>
                <a href="{{url('/vefsida',  $vefsida->all()[$i]->id)}}">{{ $vefsida->all()[$i]->title }}</a>
              </h2></li>
                @if(strlen($vefsida->all()[$i]->body) > 250)<li>{{
                  substr($vefsida->all()[$i]->body,0,249) }}...</li>
                @else
                <li>{{$vefsida->all()[$i]->body}}</li>
                @endif
        @endfor

   @endif
</ul>

 </div>
</div>




@stop
@section('content')
<div class="col-sm-13">

  <div>
    <h1>Frétt Dagsins</h1>
    <br>
     <pre><h4>{{$forsida->frettdagsins}}</h4></pre>
  </div>

<div class="modal" id="editfrett" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit comment</h4>
      </div>
      <div class="modal-body">
        <p>Breyta Frétt Dagsins</p>
        <form action="/frett" method="POST" enctype="multipart/form-data" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="frettdagsins">
        <textarea class="form-control" placeholder="Ný Frétt" name="frettinn">{{$forsida->frettdagsins}}</textarea>
        <input type="submit" value="Staðfesta frett" class="btn btn-orimary btn-lg">
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@if($user->id <= 2)
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#editfrett">Edit</a>
@endif
@stop

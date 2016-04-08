<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@extends('app')

@section('content')
  <h1>Write a new fyrirspurn</h1>

  <hr/>
  {!! Form::open(['url' => '/vefsida' , 'method' => 'post', 'files' => true]) !!}
      <div Class="form-group">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
      </div>

      <div Class="form-group">
        {!! Form::hidden('hofundur', 'Hofundur:') !!}
        {!! Form::hidden('hofundur', Auth::user()->username, ['class' => 'form-control']) !!}
      </div>
      <div Class="form-group">
        {!! Form::hidden('current_photo', Auth::user()->profilephoto, ['class' => 'form-control']) !!}
      </div>
      <div Class="form-group">
        {!! Form::hidden('starfsmadur', 'none', ['class' => 'form-control']) !!}
      </div>

      <div Class="form-group">
        {!! Form::label('body', 'Body:') !!}
        {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
      </div>
      <div Class="form-group" id="uphlada_img">
        {!! Form::label('upload', 'Uphlaða Mynd:') !!}
        {!! Form::file('uphladaimg1', null, ['class' => 'form-control', 'name' => 'uphladaimg1']) !!}
      </div>
      <a href="#" id="plusa_Vidimg"><h1>+</h1></a>
      <div Class="form-group" id="uphlada_file" >
        {!! Form::label('upload', 'Upphlaða Skrá:') !!}
        {!! Form::file('uphladafile1', null, ['class' => 'form-control', 'name' => 'uphladafile1']) !!}
      </div>
      <<a href="#" id="plusa_Vidfile"><h1>+</h1></a>
      <script>
      var filenumber = 2;
      var filenumber2 = 2;
      $('#plusa_Vidimg').click(function(){
        $('#uphlada_img').append('<label for="uphladaimg1">Uphlaða Mynd:</label> <input name="uphladaimg'+ filenumber +'" type="file" id="uphladaimg'+ filenumber +'">');
         filenumber++
      })
      $('#plusa_Vidfile').click(function(){
        $('#uphlada_file').append('<label for="uphladafile1">Uphlaða Skrá:</label> <input name="uphladafile'+ filenumber2 +'" type="file" id="uphladafile'+ filenumber2 +'">');
        filenumber2++
      })
      </script>





      <div Class="form-group">
        {!! Form::submit('Add Fyrirspurn', ['class' => 'btn btn-primary form-control']) !!}
      </div>
  {!! Form::close() !!}
@stop

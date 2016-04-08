@extends('app')

@section('content')
  <h1>Breyta fyrirspurn</h1>

  {!! Form::open(['url' => '/vefsida/' . $vefsida->id ]) !!}
      <div Class="form-group">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', $vefsida->title, ['class' => 'form-control']) !!}
      </div>

      <div Class="form-group">
        {!! Form::label('body', 'Body:') !!}
        {!! Form::textarea('body', $vefsida->body, ['class' => 'form-control']) !!}
      </div>
      <div Class="form-group">
        {!! Form::hidden('id', $vefsida->id, ['class' => 'form-control']) !!}
      </div>

      <div Class="form-group">
        {!! Form::submit('Edit', ['class' => 'btn btn-primary form-control']) !!}
      </div>
  {!! Form::close() !!}
@stop

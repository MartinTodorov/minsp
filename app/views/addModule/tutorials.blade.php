@extends('layout.main')

@section('content')
@if(Auth::check())
<p>Hello , {{ Auth::user()->real_name }} </p>
<form method="post" action="{{URL::route('add-tutorials-post')}}" enctype="multipart/form-data">
    Link:<input type="text" name="name"{{ (Input::old('name')) ? ' value="' .e(Input::old('name')). '"' : ''  }}>
    <br>(YouTube)
    @if($errors->has('name'))
    {{ $errors->first('name') }}
    @endif  
    <br>Description :<textarea name="description"{{ (Input::old('description')) ? ' value="' .e(Input::old('description')). '"' : ''  }}></textarea>    
    @if($errors->has('description'))
    {{ $errors->first('description') }}
    @endif
    <br>
    <input type="submit" value="add tutorial">
    {{Form::token()}}
</form>
@else
<p> You are not sign in. </p>
@endif
@stop
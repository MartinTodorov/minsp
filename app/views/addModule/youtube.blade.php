@extends('layout.main')

@section('content')
@if(Auth::check())
<p>Hello , {{ Auth::user()->real_name }} </p>
<form method="post" action="{{URL::route('add-media-post')}}" enctype="multipart/form-data">
    Link:<input type="text" name="link"{{ (Input::old('link')) ? ' value="' .e(Input::old('link')). '"' : ''  }}>
    <br>(YouTube/SoundCloud)
    @if($errors->has('link'))
    {{ $errors->first('link') }}
    @endif   
    <br>  
    <p id="OMC">Add to Online Music Contest<h6>(Add hashtag)</h6></p>
    <input type="text" id="hashtag" name="hashtag"{{ (Input::old('hashtag')) ? ' value="' .e(Input::old('hashtag')). '"' : ''  }}>
    <input type="submit" value="Add">
    {{Form::token()}}
</form>
@else
<p> You are not sign in. </p>
@endif
@stop
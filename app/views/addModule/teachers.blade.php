@extends('layout.main')

@section('content')
@if(Auth::check())
<p>Hello , {{ Auth::user()->real_name }} </p>
<form method="post" action="{{URL::route('add-teachers-post')}}" enctype="multipart/form-data">
    Name:<input type="text" name="name"{{ (Input::old('name')) ? ' value="' .e(Input::old('name')). '"' : ''  }}>
    @if($errors->has('name'))
    {{ $errors->first('name') }}
    @endif
    
    <br>Description :<input type="text" name="description"{{ (Input::old('description')) ? ' value="' .e(Input::old('description')). '"' : ''  }}>
    @if($errors->has('description'))
    {{ $errors->first('description') }}
    @endif
    
    <br>Avatar :<input type="file" name="avatar"{{ (Input::old('avatar')) ? ' value="' .e(Input::old('avatar')). '"' : ''  }}>
    @if($errors->has('avatar'))
    {{ $errors->first('avatar') }}
    @endif<br>
    <input type="submit" value="add teacher">
    {{Form::token()}}
</form>
@else
<p> You are not sign in. </p>
@endif
@stop
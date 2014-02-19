@extends('layout.main')

@section('content')
@if(Auth::check())
<p>Hello , {{ Auth::user()->real_name }} </p>
<form method="post" action="{{URL::route('add-musicians-post')}}" enctype="multipart/form-data">
    Name:<input type="text" name="name"{{ (Input::old('name')) ? ' value="' .e(Input::old('name')). '"' : ''  }}>
    @if($errors->has('name'))
    {{ $errors->first('name') }}
    @endif
    <br>Contact  :<input type="text" name="contact"{{ (Input::old('contact')) ? ' value="' .e(Input::old('contact')). '"' : ''  }}>
    @if($errors->has('contact'))
    {{ $errors->first('contact') }}
    @endif
    <br>Genre    :<input type="text" name="genre"{{ (Input::old('genre')) ? ' value="' .e(Input::old('genre')). '"' : ''  }}>
    @if($errors->has('genre'))
    {{ $errors->first('genre') }}
    @endif
    <br>Description :<textarea name="description"{{ (Input::old('description')) ? ' value="' .e(Input::old('description')). '"' : ''  }}></textarea>    
    @if($errors->has('description'))
    {{ $errors->first('description') }}
    @endif
    <br>Location :<input type="text" name="location"{{ (Input::old('location')) ? ' value="' .e(Input::old('location')). '"' : ''  }}>
    @if($errors->has('location'))
    {{ $errors->first('location') }}
    @endif
    <br>Performance :<input type="text" name="performance"{{ (Input::old('performance')) ? ' value="' .e(Input::old('performance')). '"' : ''  }}>
    @if($errors->has('performance'))
    {{ $errors->first('performance') }}
    @endif<br>
    <br>Avatar :<input type="file" name="avatar"{{ (Input::old('avatar')) ? ' value="' .e(Input::old('avatar')). '"' : ''  }}>
    @if($errors->has('avatar'))
    {{ $errors->first('avatar') }}
    @endif<br>
    <input type="submit" value="add band">
    {{Form::token()}}
</form>
@else
<p> You are not sign in. </p>
@endif
@stop
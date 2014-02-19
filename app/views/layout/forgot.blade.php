@extends('layout.main')

@section('content')
   <form method="post" action="{{URL::route('forgot-password-post')}}">
       <input type="text" name="email"{{ (Input::old('email')) ? ' value="' .e(Input::old('email')). '"' : ''  }}>
        @if($errors->has('email'))
          {{ $errors->first('email') }}
        @endif
       <input type="submit" value="Forgot password">
       {{Form::token()}}
   </form>
@stop
@extends('layout.main')

@section('content')
  <form method="post" action="{{URL::route('sign-in-account-post')}}">
      <div class="field">
          Email:   <input type="text" name="email"{{ (Input::old('email')) ? ' value="' .e(Input::old('email')). '"' : ''  }}>
          @if($errors->has('email'))
             {{ $errors->first('email') }}
          @endif
      </div>
      
      <div class="field">
          Password:<input type="password" name="password" >    
          @if($errors->has('password'))
             {{ $errors->first('password') }}
          @endif
      </div>
      
      <div class="field">
          <input type="checkbox" name="remember" id="remember">
          <label for="remember">
              Remember me
          </label>
      </div>
      
      <input type="submit" name="signin" value="Sign in">
      {{ Form::token() }}
  </form>
@stop
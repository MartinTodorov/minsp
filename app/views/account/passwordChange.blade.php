@extends('layout.main')

@section('content')
  <form method="post" action="{{URL::route('change-password-account-post')}}">
      <div class="field">
          Old password:   <input type="password" name="old_password"{{ (Input::old('old_password')) ? ' value="' .e(Input::old('old_password')). '"' : ''  }}>
          @if($errors->has('old_password'))
             {{ $errors->first('old_password') }}
          @endif
      </div>
      
      <div class="field">
          Password:<input type="password" name="password"{{ (Input::old('password')) ? ' value="' .e(Input::old('password')). '"' : ''  }}>
          @if($errors->has('password'))
             {{ $errors->first('password') }}
          @endif
      </div>
      
      <div class="field">
          Password:<input type="password" name="password_again"{{ (Input::old('password_again')) ? ' value="' .e(Input::old('password_again')). '"' : ''  }}>
          @if($errors->has('password_again'))
             {{ $errors->first('password_again') }}
          @endif
      </div>
                 
      <input type="submit" name="password_change" value="Change password">
      {{ Form::token() }}
  </form>
@stop
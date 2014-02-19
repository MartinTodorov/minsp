@extends('layout.main')

@section('content')
<form method="POST" action="{{ URL::route('create-account-post')}}">
    <div class="field">
        Email: <input type="text" name="email"{{ (Input::old('email')) ? ' value="' .e(Input::old('email')). '"' : ''  }}>
        @if($errors->has('email'))
          {{ $errors->first('email') }}
        @endif
    </div>

    <div class="field">
        Real name:  <input type="text" name="real_name"{{ (Input::old('real_name')) ? ' value="' .e(Input::old('real_name')). '"' : ''  }}>
        @if($errors->has('real_name'))
          {{ $errors->first('real_name') }}
        @endif
    </div>
    
    <div class="field">
        Password:  <input type="password" name="password"{{ (Input::old('password')) ? ' value="' .e(Input::old('password')). '"' : ''  }}>
        @if($errors->has('password'))
          {{ $errors->first('password') }}
        @endif
    </div>

    <div class="field">
        Password again: <input type="password" name="password_again"{{ (Input::old('password_again')) ? ' value="' .e(Input::old('password_again')). '"' : ''  }}>
        @if($errors->has('password_again'))
          {{ $errors->first('password_again') }}
        @endif
    </div>  
    <input type="submit" value="Create account">
    {{ Form::token()}}
</form>
@stop
<nav>
    <ul>
        <li> <a href="{{ URL::route('home') }}">Home</a> </li>
        @if(Auth::check())
         <li> <a href="{{ URL::route('sign-out-account') }}">Sign out</a> </li>
         <li> <a href="{{ URL::route('change-password-account') }}">Change password</a> </li>
        @else
        <li> <a href="{{ URL::route('sing-in-account') }}">Sign in</a> </li>
        <li> <a href="{{ URL::route('create-account') }}">Create an account</a> </li>
        <li> <a href="{{ URL::route('forgot-password') }}">Forgot password</a> </li>
        @endif                
    </ul>
</nav>
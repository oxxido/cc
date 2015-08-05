<div id="header">
    <div class="wrapper">
        <div id="logo"><a href="/home"><img src="/images/logo.png" width="265" height="70"></a></div>
        <div class="login">
            @if (Auth::guest())
            <a href="{{ url('/dashboard') }}">Client Login</a>
            @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ str_limit(Auth::user()->name,10) }} <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ url('auth/logout') }}">Logout</a></li>
                </ul>
            </li>
            @endif

        </div>
    <div class="login s80">
      <a href="{{url('/faqs')}}" class="">FAQs</a>
    </div>
    <div class="login s80">
      <a href="{{url('/pricing')}}" class="">Pricing</a>
    </div>
    <div class="login">
      <a href="{{url('/howitworks')}}">How it works</a>
    </div>
    </div>
</div>
<div id="loginbanner">

</div>
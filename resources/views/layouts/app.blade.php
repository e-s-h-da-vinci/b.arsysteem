
<!doctype html>

<html lang="en">
    <head>
      <meta charset="utf-8">

      <title>B.arsysteem - @yield('title')</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
      <link href="https://fonts.googleapis.com/css?family=Arvo:400,700|Cabin:400,300" rel="stylesheet">
      <link href="{{ url('css/styles.css') }}" rel="stylesheet">
      <meta name="theme-color" content="#AE202E">
      @yield('header')
    </head>
    <body>
    	<div class="header">
    		<div class="ui container">
    			<h1 class="mainTitle">B.arsysteem</h1>
                @if($login_user)
                    <h3 class="subTitle">
                        @if($login_user['infix'])
                            Welcome {{ $login_user['first_name'] }} {{ $login_user['infix'] }} {{ $login_user['last_name'] }}@if ($login_user['is_board'])&nbsp;&nbsp;<div class="ui purple horizontal label">Board</div>@endif, <a href="/logout">logout?</a>
                        @else
                            Welcome {{ $login_user['first_name'] }} {{ $login_user['last_name'] }}@if ($login_user['is_board'])&nbsp;&nbsp;<div class="ui purple horizontal label">Board</div>@endif, <a href="/logout">logout?</a>
                        @endif
                    </h3>
                @endif
    			<img class="logo" src="{{ url('images/logo-full.svg') }}">
    		</div>
    	</div>
      <div class="content">
    		<div class="ui container">
    			<div class="mobile-header">
    				<h1>@yield('title')</h1>
                    @if($login_user)
                        <h3>
                            @if($login_user['infix'])
                                Welcome {{ $login_user['first_name'] }} {{ $login_user['infix'] }} {{ $login_user['last_name'] }}@if ($login_user['is_board'])&nbsp;&nbsp;<div class="ui purple horizontal label">Board</div>@endif, <a href="/logout">logout?</a>
                            @else
                                Welcome {{ $login_user['first_name'] }} {{ $login_user['last_name'] }}@if ($login_user['is_board'])&nbsp;&nbsp;<div class="ui purple horizontal label">Board</div>@endif, <a href="/logout">logout?</a>
                            @endif
                        </h3>
                    @endif
    			</div>
          @yield('content')
          <div class="footer">
              <p class="grey">B.arsysteem v1.2 by Christiaan Goossens, maintained by the CommunicatCie.</p>
          </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
    @yield('scripts')
  </body>
</html>

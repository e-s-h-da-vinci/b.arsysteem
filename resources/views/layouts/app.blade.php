
<!doctype html>

<html lang="en">
    <head>
      <meta charset="utf-8">

      <title>Da Vinci - @yield('title')</title>
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
    			<h1 class="mainTitle">@yield('title')</h1>
    			<div class="menu">@yield('menu')</div>
    			<img class="logo" src="{{ url('images/logo-full.svg') }}">
    		</div>
    	</div>
      <div class="content">
    		<div class="ui container">
    			<div class="mobile-header">
    				<h1>@yield('title')</h1>
    				<div class="menu">@yield('menu')</div>
    			</div>
          @yield('content')
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
    @yield('scripts')
  </body>
</html>

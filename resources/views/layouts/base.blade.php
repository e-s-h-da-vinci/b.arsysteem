@extends('layouts.app')

@section('content')
    <div class="ui stackable grid">
        <div class="four wide column">
            <div class="ui vertical fluid pointing menu">
              <a class="{{ ($url === '/') ? 'active item' : 'item' }}" href="/">
                Dashboard
              </a>
              <a class="{{ ($url === '/bar') ? 'active item' : 'item' }}" href="/bar">
                Bar
              </a>
              <a  class="{{ ($url === '/bows') ? 'active item' : 'item' }}" href="/bows">
                Bow Registration
              </a>
              <a  class="{{ ($url === '/profile') ? 'active item' : 'item' }}" href="/profile">
                My Profile
              </a>
            </div>
        </div>
      <div class="twelve wide column">@yield('innerContent')</div>
    </div>
@endsection

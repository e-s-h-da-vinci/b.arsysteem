@extends('layouts.app')

@section('title', 'Login')

@section('header')
    <link href="{{ url('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="login ui container center aligned">
     <div class="ui segment">
       <form class="ui large form">
        <div class="field">
          <select class="ui search dropdown">
            <option value="">Select your name</option>
            @foreach ($members as $value => $name)
              <option value="{{ $value }}">{{ $name }}</option>
            @endforeach
          </select>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="pincode" placeholder="Pincode">
          </div>
        </div>
        <div class="ui fluid large violet submit button">Login</div>
        <div class="ui error message"></div>
      </form>
     </div>
    </div>
@endsection

@section('scripts')
<script>
  $('select.dropdown')
  .dropdown()
;
</script>
@endsection

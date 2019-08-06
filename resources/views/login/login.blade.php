@extends('layouts.app')

@section('title', 'Login')

@section('header')
    <link href="{{ url('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="login ui container center aligned">
     @if($error === "1")
         <div class="ui yellow message">Incorrect credentials. Try again.</div>
     @elseif($error === "2")
         <div class="ui yellow message">Server issues. Please try again later.</div>
     @endif
     <div class="ui segment">
       <form class="ui large form" method="post">
        <div class="field">
          <select class="ui search dropdown" name="userId">
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
        <button class="ui button large violet fluid" type="submit">Login</button>
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
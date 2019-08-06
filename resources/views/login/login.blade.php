@extends('layouts.app')

@section('title', 'Login')

@section('header')
    <link href="{{ url('css/small.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="small ui container center aligned">
     @if($error === "1")
         <div class="ui yellow message">Incorrect credentials. Try again.</div>
     @elseif($error === "2")
         <div class="ui yellow message">Server issues. Please try again later.</div>
     @elseif($error === "3")
         <div class="ui yellow message">User failure. Please try again.</div>
     @elseif($error === "4")
         <div class="ui green message">New pin set. Please login again.</div>
     @endif
     <div class="ui segment">
       <form class="ui large form" method="post">
        <div class="field">
          <select class="ui search dropdown" name="userId" required>
            <option value="">Select your name</option>
            @foreach ($members as $value => $name)
              <option value="{{ $value }}">{{ $name }}</option>
            @endforeach
          </select>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="pincode" placeholder="Pincode" pattern="[0-9]{4,10}" maxlength="10">
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

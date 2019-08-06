@extends('layouts.app')

@section('title', 'Login')

@section('header')
    <link href="{{ url('css/small.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="small ui container center aligned">
     <div class="ui segment">
       <form class="ui large form" method="post">
        <div class="field">
          <p class="grey">You have never used this application before, or your pincode has been reset, and therefore you will have to pick a new pincode.</p>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="pincode" placeholder="Pincode">
          </div>
        </div>
        <button class="ui button large violet fluid" type="submit">Set Pincode for my Account</button>
      </form>
     </div>
    </div>
@endsection

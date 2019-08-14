@extends('layouts.app')

@section('title', 'iDeal')

@section('header')
    <link href="{{ url('css/small.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="small ui container center aligned">
        <div class="ui card fluid">
            <div class="content">
              <div class="header">Payment through iDeal</div>
            </div>
            <div class="content">
              <h4 class="ui sub header">Description</h4>
              <p>{{ $payment['description'] }}</p>
                <h4 class="ui sub header">Amount</h4>
                <p>@euro($payment['amount'])</p><br/>
              <div class="ui green message">You have paid! You can close this window, or go to the B.arsysteem.</div>
            </div>
            <div class="extra content">
              <a href="/bar?status=ok"><button class="ui button">Open the B.arsysteem</button></a>
            </div>
        </div>
      </div>
@endsection

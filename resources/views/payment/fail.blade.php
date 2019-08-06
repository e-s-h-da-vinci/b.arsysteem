@extends('layouts.app')

@section('title', 'iDeal')

@section('header')
    <link href="{{ url('css/small.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="small ui container center aligned">
      <div class="ui card fluid">
          <div class="content"><div class="ui red message"><h3>Paying through iDeal failed</h3><br/>
              You should contact the Treasurer for assistance with the following data, or if no payment has been made yet at your bank, you can try again:<br/>
              <h5>Internal Transaction ID</h5>
                  <p>{{ $id }}</p>
                <h5>External Transaction ID</h5>
                <p>{{ $trxId }}</p>
                <h5>Error Code</h5>
                <p>{{ $code }}</p>
              <h5>Error Message</h5>
              <p>{{ $message }}</p></div></div>
          <div class="extra content">
            <a href="?"><button class="ui button">Try again</button></a>
          </div>
      </div>

    </div>
@endsection

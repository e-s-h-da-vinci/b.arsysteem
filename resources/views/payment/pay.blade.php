@extends('layouts.app')

@section('title', 'iDeal')

@section('header')
    <link href="{{ url('css/small.css') }}" rel="stylesheet">
@endsection

@section('content')
    <form class="ui form" method="post">
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
            <p>Please pick your bank:</p>
            <select class="ui fluid dropdown" name="bankId">
                @foreach($banks as $key => $bank):
                    <option value="{{$key}}">{{$bank}}</option>
                @endforeach
            </select>
          </div>
          <div class="extra content">
            <button class="ui red button">Pay</button>
          </div>
      </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
  $('select.dropdown')
  .dropdown()
;
</script>
@endsection

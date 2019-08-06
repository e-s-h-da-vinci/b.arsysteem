@extends('layouts.base')
@section('title', 'Bar')
@section('innerContent')
    <p class="grey">Welcome to the bar! Your saldo is: <b>&euro; {{ money_format('%!n', $saldo) }}</b>.</p>

    @if($status === "ok")
        <div class="ui green message">Successfully entered your transaction into the system. Your new saldo is: <b>&euro; {{ money_format('%!n', $saldo) }}</b>.</div>
    @elseif($status === "fail")
        <div class="ui red message">Failed to properly process your transaction. Please try again.</div>
    @endif

    <form class="ui form" method="post">
      <div class="field">
          <table class="ui celled table">
              <thead>
                <tr><th>Quantity</th>
                <th>Product</th>
                <th>Price</th>
              </tr></thead>
              <tbody>
                @foreach($items as $item)
                <tr>
                  <td class="two wide"><input type="text" name="amount[{{ $item['id'] }}]" value="0"></td>
                  <td>{{ $item['name'] }}</td>
                  <td class="two wide">&euro; {{ money_format('%!n', $item['price']) }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
      </div>
      <button class="ui purple button" type="submit">Buy</button>
    </form>

    <h4 class="grey">Adding Credit</h4>
    You can add credit through iDeal below. Pick the amount you want, and click the button.<br/><br/>
    <form class="ui form" method="post" action="/bar/add_credit">
        <div class="field">
            <select class="ui fluid dropdown">
                @foreach($upgradables as $amount):
                    <option value="{{$amount['id']}}">{{ $amount['name']}}</option>
                @endforeach
            </select>
        </div>
        <button class="ui button" type="submit">Add Credit through iDeal</button>
    </form>

    <h4 class="grey">My Latest Transactions</h4>
        <table class="ui celled table">
            <thead>
              <tr>
                  <th>Product</th>
                  <th>At</th>
              </tr>
          </thead>
            <tbody>
              @foreach($transactions as $transaction)
              <tr>
                <td>{{ $transaction['product']['name'] }}</td>
                <td>{{ date('d-m-Y - H:i:s', strtotime($transaction['updated_at'])) }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
@endsection

@section('scripts')
<script>
  $('select.dropdown')
  .dropdown()
;
</script>
@endsection

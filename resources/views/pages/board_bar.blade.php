@extends('layouts.base')

@section('title', 'Board Bar')

@section('innerContent')
    <h4 class="grey">Manual Add Credit</h4>
    You can use this to manually add credit to someone.<br/><br/>
    <form class="ui form" method="post" action="/board/bar/add_credit">
        <div class="field">
            <label>Member</label>
            <select class="ui fluid dropdown" name="user_id">
                @foreach($members as $id => $member):
                    <option value="{{$id}}">{{ $member}}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label>Amount</label>
            <input type="text" name="amount" placeholder="10.00">
          </div>
        <button class="ui button" type="submit">Add Credit</button>
    </form>

    <h4 class="grey">Current Saldos</h4>
        <table class="ui celled table">
            <thead>
              <tr>
                  <th>User</th>
                  <th>Saldo</th>
              </tr>
          </thead>
            <tbody>
              @foreach($saldos as $saldo)
              <tr>
                <td>{{ $members[$saldo['user_id']] ?? 'Unknown, deleted?' }}</td>
                <td>&euro; {{ money_format('%!n', $saldo['saldo']) }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>

    <h4 class="grey">All Bar Transactions</h4>
        <table class="ui celled table">
            <thead>
              <tr>
                  <th>User</th>
                  <th>Product</th>
                  <th>At</th>
                  <th>Amount</th>
              </tr>
          </thead>
            <tbody>
              @foreach($transactions as $transaction)
              <tr>
                <td>{{ $members[$transaction['user_id']] ?? 'Unknown, deleted?' }}</td>
                <td>{{ $transaction['product']['name'] }}</td>
                <td>{{ date('d-m-Y - H:i:s', strtotime($transaction['updated_at'])) }}</td>
                <td>&euro; {{ money_format('%!n', $transaction['amount']) }}</td>
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

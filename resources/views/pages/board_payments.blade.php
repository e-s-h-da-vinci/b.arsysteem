@extends('layouts.base')

@section('title', 'Board Payments')

@section('innerContent')
    <h4 class="grey">All iDeal Transactions</h4>
        <table class="ui celled table">
            <thead>
              <tr>
                  <th>User</th>
                  <th>Internal Reference</th>
                  <th>Sisow Reference</th>
                  <th>Description</th>
                  <th>Amount</th>
                  <th>Paid</th>
                  <th>Created</th>
                  <th>Updated</th>
              </tr>
          </thead>
            <tbody>
              @foreach($transactions as $transaction)
              <tr>
              <td>{{ $members[$transaction['user_id']] }}</td>
                <td>{{ $transaction['encoded_id'] }}</td>
                <td>{{ $transaction['ext_ref'] }}</td>
                <td>{{ $transaction['description'] }}</td>
                <td>&euro; {{ money_format('%!n', $transaction['amount']) }}</td>
                <td>{{ $transaction['paid'] ? 'Yes' : 'No' }}</td>
                <td>{{ date('d-m-Y - H:i:s', strtotime($transaction['created_at'])) }}</td>
                <td>{{ date('d-m-Y - H:i:s', strtotime($transaction['updated_at'])) }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
@endsection

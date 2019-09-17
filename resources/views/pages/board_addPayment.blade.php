@extends('layouts.base')

@section('title', 'Board custom payment')

@section('innerContent')
    <h4 class="grey">Add custom payment</h4>
    @if($status === "success")
        <div class="ui green message">Successfully added new transaction: <a href="{{ $paymentUrl }}">{{ $paymentUrl }}</a></div>
    @elseif($status === "fail")
        <div class="ui red message">Failed to properly process your transaction. Please try again.</div>
    @endif
    <p>To add a custom payment, use the form below. You cannot request payments lower than 1 euro.</p>
    <form class="ui form" method="post">
      <div class="field">
        <label>Description</label>
        <input type="text" name="description" placeholder="Description on the payment, this will appear on the bank statement of the recipient.">
      </div>
      <div class="field">
        <label>Amount</label>
        <input type="number" name="amount" min="1" step = "0.01" placeholder="Amount">
      </div>
      <button class="ui button" type="submit">Submit</button>
    </form>
@endsection

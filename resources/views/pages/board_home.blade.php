@extends('layouts.base')

@section('title', 'Board Dashboard')

@section('innerContent')
    <div class="ui stackable grid">
      <div class="eight wide column">
          <div class="ui card fluid">
            <div class="content">
              <div class="header">Bar Management</div>
            </div>
            <div class="content">
                <a href="/board/bar"><button class="ui purple basic button">Bar Management</button></a>
            </div>
          </div>
      </div>
      <div class="eight wide column">
          <div class="ui card fluid">
            <div class="content">
              <div class="header">Payments</div>
            </div>
            <div class="content">
                <a href="/board/payments"><button class="ui purple basic button">Payment List</button></a>
                <a href="/board/payment/add"><button class="ui purple basic button">Add Custom Payment</button></a>
            </div>
          </div>
      </div>
    </div>
    <div class="ui stackable grid">
      <div class="eight wide column">
          <div class="ui card fluid">
            <div class="content">
              <div class="header">Bow Use List</div>
            </div>
            <div class="content">
                <a href="/board/bows"><button class="ui purple basic button">Bar Use List</button></a>
            </div>
          </div>
      </div>
      <div class="eight wide column">
          <div class="ui card fluid">
            <div class="content">
              <div class="header">Member Admin</div>
            </div>
            <div class="content">
                <a href="/board/members/add"><button class="ui purple basic button">Sign up new member</button></a>
            </div>
          </div>
      </div>
    </div>
@endsection

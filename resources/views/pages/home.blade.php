@extends('layouts.base')

@section('title', 'Dashboard')

@section('innerContent')
    <div class="ui stackable grid">
      <div class="eight wide column">
          <div class="ui card fluid">
            <div class="content">
              <div class="header">Bar</div>
            </div>
            <div class="content">
                <p>Whenever you get a drink from the fridge, you will have to register it here.</p><br/>
                <a href="/bar"><button class="ui purple basic button">Open the Bar</button></a>
            </div>
          </div>
      </div>
      <div class="eight wide column">
          <div class="ui card fluid">
            <div class="content">
              <div class="header">Bows</div>
            </div>
            <div class="content">
                <p>As we would like statistics on bow usage, please register your use of the club bows here:</p><br/>
                <a href="/bows"><button class="ui purple basic button">Open the Bow Registration page</button></a>
            </div>
          </div>
      </div>
    </div>
@endsection

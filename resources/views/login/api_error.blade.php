@extends('layouts.app')

@section('title', 'Error')

@section('header')
    <link href="{{ url('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="login ui container center aligned">
     <div class="ui segment">
       The B.arsysteem app is currently offline due to downtime at Lassie. Sorry!
     </div>
    </div>
@endsection

@section('scripts')
<script>
  $('select.dropdown')
  .dropdown()
;
</script>
@endsection

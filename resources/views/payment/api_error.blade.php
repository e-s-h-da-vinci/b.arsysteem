@extends('layouts.app')

@section('title', 'Error')

@section('header')
    <link href="{{ url('css/small.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="small ui container center aligned">
     <div class="ui segment">
       The B.arsysteem app is currently offline due to downtime at Sisow. Sorry!
     </div>
    </div>
@endsection

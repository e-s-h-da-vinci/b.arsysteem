@extends('layouts.base')

@section('title', 'Board Bows')

@section('innerContent')
    <h4 class="grey">All Bow Usage</h4>
        <table class="ui celled table">
            <thead>
              <tr>
                  <th>User</th>
                  <th>Bow</th>
                  <th>At</th>
              </tr>
          </thead>
            <tbody>
              @foreach($bows as $bow)
              <tr>
              <td>{{ $members[$bow['user_id']] }}</td>
                <td>{{ $bow['bow']['description'] }}</td>
                <td>{{ date('d-m-Y', strtotime($bow['updated_at'])) }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
@endsection

@extends('layouts.base')

@section('title', 'Bow Registration')

@section('innerContent')
    @if($status === "ok")
        <div class="ui green message">Succesfully registered bow use.</div>
    @elseif($status === "fail")
        <div class="ui red message">Failed to register bow use.</div>
    @endif
    <h4 class="grey">Register bow use</h4>
Please add your bow usage below when you use a club bow. No costs are charged for using club bows, this is only for measuring wear and tear on the material and keeping track of material maintenance needs.<br/><br/>
<form class="ui form" method="post">
    <div class="field">
        <select class="ui fluid dropdown" name="bow">
            @foreach($bows as $bow):
                <option value="{{$bow['id']}}">{{ $bow['description']}}</option>
            @endforeach
        </select>
    </div>
    <button class="ui button" type="submit">Register</button>
</form>
    <h4 class="grey">Last Used Bows (max 20)</h4>
        <table class="ui celled table">
            <thead>
              <tr>
                  <th>Bow</th>
                  <th>At</th>
              </tr>
          </thead>
            <tbody>
              @foreach($history as $use)
              <tr>
                <td>{{ $use['bow']['description'] }}</td>
                <td>{{ date('d-m-Y', strtotime($use['updated_at'])) }}</td>
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

@extends('layouts.base')

@section('title', 'Ladder')

@section('innerContent')
    <form class="ui form" method="get">
        <div class="ui grid">
          <div class="four wide column">
              Season:
          </div>
          <div class="four wide column">
              <select class="ui fluid dropdown" name="season" onchange="this.form.submit()">
                  @foreach($seasons as $season):
                      <option value="{{$season['id']}}">{{ $season['name']}}</option>
                  @endforeach
              </select>
          </div>
          <div class="four wide column">
              Round:
          </div>
          <div class="four wide column">
              <select class="ui fluid dropdown" name="round" onchange="this.form.submit()">
                  @foreach($rounds as $round):
                      <option value="{{$round['id']}}">Round {{ $round['round_nr']}}</option>
                  @endforeach
               </select>
          </div>
        </div>
    </form>
@endsection


@section('scripts')
<script>
  $('select.dropdown')
  .dropdown()
;
</script>
@endsection

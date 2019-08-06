@extends('layouts.base')
@section('title', 'Profile')
@section('innerContent')
        <p class="grey">In accordance with the GDPR regulations, you can view all data E.S.H. Da Vinci has about you on this page. Please ask a board member for details if anything is unclear, or if the data is incorrect.</p>

        <h5 class="grey">General</h5>
        <table class="ui celled table">
          <tbody>
            <tr>
              <td class="five wide">First Name</td>
              <td class="eleven wide">{{ $login_user['first_name'] }}</td>
            </tr>
            @if($login_user['infix'])
            <tr>
              <td>Suffix/Infix</td>
              <td>{{ $login_user['infix'] }}</td>
            </tr>
            @endif
            <tr>
              <td>Last Name</td>
              <td>{{ $login_user['last_name'] }}</td>
            </tr>
            <tr>
              <td>Birth date</td>
              <td>{{ date('d-m-Y', strtotime($login_user['birthdate'])) }}</td>
            </tr>
            <tr>
              <td>Generation (year of joining Da Vinci)</td>
              <td>{{ $login_user['generation'] }}</td>
          </tr>
          </tbody>
      </table>
        <br/>
        <h5 class="grey">Contact Details</h5>
        <table class="ui celled table">
          <tbody>
            <tr>
              <td class="five wide">Email</td>
              <td class="eleven wide">{{ $login_user['email'] ?: 'Not given' }}</td>
            </tr>
            <tr>
              <td>Phone number</td>
              <td>{{ $login_user['phone'] ?: 'Not given' }}</td>
            </tr>
            <tr>
              <td>Home Address</td>
              <td>{{ $login_user['address']['street'] ?: 'Unknown Street' }} {{ $login_user['address']['number'] ?: 'Unknown Number' }},<br/>
              {{ $login_user['address']['city'] ?: 'Unknown City' }} {{ $login_user['address']['country'] ?: 'Unknown Country' }}</td>
            </tr>
          </tbody>
        </table>
        <br/>
        <h5 class="grey">Study/SSC Data</h5>
        <table class="ui celled table">
          <tbody>
            <tr>
              <td class="five wide">SSC Number</td>
              <td class="eleven wide">{{ $login_user['ssc_number'] }}</td>
            </tr>
            <tr>
              <td>Study</td>
              <td>{{ $login_user['study'] ?: 'Not registered.' }}</td>
            </tr>
            <tr>
              <td>Institution</td>
              <td>{{ $login_user['institution'] ?: 'Not registered.' }}</td>
            </tr>
          </tbody>
        </table><br/>
        <h5 class="grey">Meta Data</h5>
        <table class="ui celled table">
          <tbody>
            <tr>
              <td class="five wide">NHB number</td>
              <td class="eleven wide">{{ $login_user['meta']['nhb_number'] ?: 'No NHB member number in the system.' }}</td>
            </tr>
            <tr>
              <td>External NHB member?</td>
              <td>{{ $login_user['meta']['external_NHB'] ?: 'unknown' }}</td>
            </tr>
            <tr>
              <td>Bar Certificate?</td>
              <td>{{ $login_user['meta']['bar_certificate'] ?: 'unknown' }}</td>
            </tr>
            <tr>
              <td>BHV Certificate?</td>
              <td>{{ $login_user['meta']['bhv_certificate'] ?: 'unknown' }}</td>
            </tr>
            <tr>
              <td>EHBO Certificate?</td>
              <td>{{ $login_user['meta']['EHBO_certificate'] ?: 'unknown' }}</td>
            </tr>
            <tr>
              <td>Honorary Member?</td>
              <td>{{ $login_user['meta']['honorary_member'] ?: 'unknown' }}</td>
            </tr>
          </tbody>
        </table>
@endsection

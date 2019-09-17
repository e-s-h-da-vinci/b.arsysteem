@extends('layouts.base')

@section('title', 'Register new member')

@section('innerContent')
    <h3 class="grey">Welcome, new member!</h3>
        <p>Please fill the form below to sign up to be an archer at Da Vinci.<br/><span class="grey">All fields with a star are required. More details about why the fields are required, can be found in our Privacy Policy, as published on the website.</span></p><br/>
        <form class="ui form" method="post">
            <h4 class="ui dividing header">Personal Information</h4>
            <div class="three fields">
                  <div class="required field">
                    <label>Initials</label>
                    <input required type="text" name="initials" placeholder="E.">
                  </div>
                  <div class="field required">
                    <label>First Name</label>
                    <input required type="text" name="first_name" placeholder="Edward">
                  </div>
                  <div class="field required">
                    <label>Last Name (Surname)</label>
                    <input required type="text" name="surname" placeholder="Xample">
                  </div>
                </div>
                <div class="field required">
                    <label>Birth Date</label>
                    <input required type="text" name="birthdate" placeholder="DD-MM-YYYY">
                  </div>
                <h4 class="ui dividing header">Contact Information</h4>
                <div class="field required">
                      <label>Address</label>
                      <div class="fields">
                        <div class="twelve wide field">
                          <input required type="text" name="address" placeholder="Example Str.">
                        </div>
                        <div class="four wide field">
                          <input required type="text" name="address_number" placeholder="3">
                        </div>
                      </div>
                    </div>
                  <div class="two fields">
                        <div class="field required">
                          <label>Postcode</label>
                          <input required type="text" name="postal_address" placeholder="1111 AA">
                        </div>
                        <div class="field required">
                          <label>City/Town</label>
                          <input required type="text" name="city" placeholder="Edward">
                        </div>
                        <div class="field">
                          <label>Country</label>
                          <input type="text" name="country" placeholder="If not entered, NL is assumed.">
                        </div>
                      </div><br/>
                      <div class="field required">
                          <label>E-mail Address</label>
                          <input required type="text" name="primary_email" placeholder="e.xample@eshdavinci.nl">
                      </div><br/>
                    <div class="field required">
                        <label>Phone (Whatsapp)</label>
                        <span class="grey">You'll be added to our informational Whatsapp group, as well as the social Whatsapp group. You're free these groups at any time.</span><br/><br/>
                        <input required type="text" name="home_phone" placeholder="06123456789">
                     </div>
             <h4 class="ui dividing header">Quick check, are you a student?</h4>
                <div class="ui violet message">To join Da Vinci, you are required to have a <b>Student</b> Sports Card at the SSCE (Student Sports Centre Eindhoven). Only Student (including PhD) cards, for either half a year, or a year are eligable for membership. TU/e Employees or Alumni cannot join Da Vinci.</div>
                <br/>
                <div class="field required">
                    <label>Where do you study?</label>
                    <select required name="institution" class="ui dropdown">
                      <option value="">Select Institution</option>
                      <option value="TUE">Eindhoven University of Technology</option>
                      <option value="FONTYS">Fontys</option>
                      <option value="OTHER">Other institution</option>
                    </select>
                  </div><br/>
                  <div class="field required">
                      <label>What do you study?</label>
                      <input required type="text" name="study" placeholder="Computer Science and Engineering (or: Design at Avans Den Bosch)">
                  </div>
                   <h4 class="ui dividing header">Nearly done, some more questions about your membership</h4>
                    <div class="ui grid">
                       <div class="eight wide column">
                           <div class="ui segment">
                           <p><b>I am new to archery</b><br/><br/>
                               If you are not already a member at another club, you can continue below. Da Vinci offers two types of memberships: <br/><br/>
                               <i>Recreationist</i><br/>
                               You are allowed to join all trainings and activities, but <b>not competitions</b>. Additionally, you are not a full member of Da Vinci, and you can thus not vote at the General Assembly. Recreationists only allowed on the Outdoor Range during trainings.<br/><br/>
                               <i>Full Membership</i><br/>
                               You can join all Da Vinci activities, competitions and trainings. As you are a full member, you can also vote at the GA. You also become a member of the Dutch Archery Bond. Full members are allowed to use the Outdoor Range at any time, also when Da Vinci is closed.<br/><br/>

                               <div class="grouped fields">
                                   <label>Pick your preferred type:</label>
                                    <div class="field">
                                      <div class="ui radio checkbox">
                                        <input type="radio" name="membership_type" class="hidden">
                                        <label>Recreationist (&euro;40,-)</label>
                                      </div>
                                    </div>
                                    <div class="field">
                                      <div class="ui radio checkbox">
                                        <input  type="radio" name="membership_type" class="hidden">
                                        <label>Full Membership (&euro;75,-)</label>
                                      </div>
                                  </div><br/>
                                </div><span class="grey">If you join after February, you'll get a 50% discount as you will only join for half a year. Additionally, your Beginners' Course fee, if applicable, may be deducted from the membership fee.<br/><br/>For exact pricing, please ask the Treasurer.</span>
                           </p>
                       </div>
                       </div>
                       <div class="eight wide column">
                           <div class="ui segment">
                               <p><b>I am already a member at an archery club</b><br/><br/>
                               If you are already an NHB member (a member of the Dutch Archery Bond) at another club, you only have one option for membership here. Please tick the box below, and enter your NHB number.</p>
                               <div class="field">
                                <div class="ui checkbox">
                                  <input type="checkbox" name="external_nhb" class="hidden">
                                  <label>I am already an NHB member externally</label>
                                </div>
                              </div>
                              <div class="ui form">
                                  <div class="field">
                                    <label>NHB Member Number</label>
                                    <input type="text" name="nhb_number">
                                  </div>
                              </div><br/>
                              <span class="grey">For you, Da Vinci Full Membership will cost &euro;40,- (or &euro;20,- if you join after Feb), as you already pay NHB member fees elsewhere.</span>
                           </div>
                       </div>
                     </div>
             <h4 class="ui dividing header">And finally..</h4>
               <div class="ui segment">
                <div class="field required">
                  <div class="ui toggle checkbox">
                    <input type="checkbox" name="ssc_check" class="hidden" required>
                    <label>I would like to become a member/recreationist at Da Vinci. I know that I will be obligated to pay the required fee after submitting this form. I am aware that I can request the Bylaws, House Rules, Safety Rules and Privacy Policy through a board member, or the website. I am aware that I am expected to read these documents before joining Da Vinci, and I agree with the contents of these documents. I consent to being added to said Whatsapp groups, with the right to leave at any time, as well as to the newsletter mailinglist.</label>
                  </div>
                </div>
              </div>
            <button class="ui violet button" type="submit">I want to join Da Vinci, submit my form!</button>
        </form>
@endsection


@section('scripts')
<script>
$('.ui.checkbox')
  .checkbox()
;
$('select.dropdown')
  .dropdown()
;
</script>
@endsection

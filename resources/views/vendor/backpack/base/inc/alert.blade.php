@if(Session::has('update'))
<div class="alert alert-success alert-dismissible" style="padding: 5px 15px 5px 10px">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <b>You have successfully updated its data</b>

</div>
@endif
@if(Session::has('insert'))
<div class="alert alert-success alert-dismissible" style="padding: 5px 15px 5px 10px">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <b>You have successfully created new data</b>

</div>
@endif
@if(Session::has('delete'))
<div class="alert alert-success alert-dismissible" style="padding: 5px 15px 5px 10px">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <b>You have successfully removed its data</b>

</div>
@endif
@if(Session::has('send_email'))
<div class="alert alert-success alert-dismissible" style="padding: 5px 15px 5px 10px">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <b>You have successfully send email to user</b>

</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible" style="padding: 5px 15px 5px 10px">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <b>{{Session::get('error')}}</b>

</div>
@endif

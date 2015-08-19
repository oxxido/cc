<!-- form start -->
{!! Form::open(array('url' => 'users', 'method' => 'post', 'role' => 'form', 'name' => 'usersAddForm', 'id' => 'usersAddForm')) !!}

@include('dashboard.usersForm')

  <div class="box-footer">
    <button class="btn btn-primary" type="submit" id="usersAddSubmit">Submit</button> 
    <button onclick="cc.user.add.cancel()" class="btn btn-default" type="button">Cancel</button>
  </div>

{!! Form::close() !!}
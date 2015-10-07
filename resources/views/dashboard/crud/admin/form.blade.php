<div class="box-body">
  <div>
    <ul class="nav nav-tabs">
      <li class="active">
        <a>User Data</a>
      </li>
    </ul>
  </div>
  <div class="panel panel-default pilled">
    <div class="panel-body">
      <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" placeholder="Enter First Name" id="first_name" class="form-control" value="@{{user.first_name}}" required>
      </div>
      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" placeholder="Enter Last Name" id="last_name" class="form-control" value="@{{user.last_name}}" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Enter Email" id="email" class="form-control" value="@{{email}}" required>
      </div>
    </div>
  </div>



</div><!-- /.box-body -->
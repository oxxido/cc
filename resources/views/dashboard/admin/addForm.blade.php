<!-- form start -->
{!! Form::open(array('role' => 'form', 'name' => 'adminAddForm', 'id' => 'adminAddForm')) !!}

	@include('dashboard.admin.form')

  <div class="box-footer">
    <button class="btn btn-primary" type="submit" id="adminAddSubmit">Submit</button> 
    <button onclick="cc.crud.admin.add.cancel()" class="btn btn-default" type="button">Cancel</button>
  </div>

{!! Form::close() !!}
<!-- form start -->
{!! Form::open(array('role' => 'form', 'name' => 'linkAddForm', 'id' => 'linkAddForm')) !!}

  <div class="box-body">
  	@include('dashboard.crud.business.link.form')
  </div>

  <div class="box-footer">
    <button class="btn btn-success" type="submit" id="linkAddSubmit">Add</button> 
    <button onclick="cc.crud.link.add.cancel()" class="btn btn-default" type="button">Cancel</button>
  </div>

{!! Form::close() !!}

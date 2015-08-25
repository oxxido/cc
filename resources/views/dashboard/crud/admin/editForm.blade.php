<!-- form start -->
{!! Form::open(array('role' => 'form', 'name' => 'adminEditForm', 'id' => 'adminEditForm')) !!}

  <input type="hidden" name="id" id="id" value="@{{id}}">
  
  @include('dashboard.crud.admin.form')

  <div class="box-footer">
    <button class="btn btn-primary" type="submit" id="adminEditSubmit">Submit</button> 
    <button onclick="cc.crud.admin.edit.cancel()" class="btn btn-default" type="button">Cancel</button>
  </div>

{!! Form::close() !!}
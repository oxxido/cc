<!-- form start -->
{!! Form::open(array('role' => 'form', 'name' => 'linkAddForm', 'id' => 'linkAddForm')) !!}

  @include('dashboard.crud.link.form')

  <div class="box-footer">
    <button class="btn btn-primary" type="submit" id="linkAddSubmit">Add</button> 
    <button onclick="cc.crud.link.add.cancel()" class="btn btn-default" type="button">Cancel</button>
  </div>

{!! Form::close() !!}

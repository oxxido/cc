<!-- form start -->
{!! Form::open(array('role' => 'form', 'name' => 'linkEditForm', 'id' => 'linkEditForm')) !!}

  <div class="box-body">
    @include('dashboard.crud.business.link.form')
  </div>

  <div class="box-footer">
    <button class="btn btn-success" type="submit" id="linkEditSubmit">Submit</button> 
    <button onclick="cc.crud.link.edit.cancel()" class="btn btn-default" type="button">Cancel</button>
  </div>

{!! Form::close() !!}

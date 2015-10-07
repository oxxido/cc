<!-- form start -->
{!! Form::open(array('role' => 'form', 'name' => 'linkEditForm', 'id' => 'linkEditForm')) !!}

  <input type="hidden" name="id" id="id" value="@{{id}}">
  <div class="box-body">
    @include('dashboard.crud.link.form')
  </div>

  <div class="box-footer">
    <button class="btn btn-success" type="submit" id="linkEditSubmit">Submit</button> 
    <button onclick="cc.crud.link.edit.cancel()" class="btn btn-default" type="button">Cancel</button>
  </div>

{!! Form::close() !!}

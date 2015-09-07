<!-- form start -->
{!! Form::open(array('role' => 'form', 'name' => 'businessEditForm', 'id' => 'businessEditForm')) !!}

  <input type="hidden" name="id" id="id" value="@{{id}}">

  @include('dashboard.crud.business.form')

  <div class="box-footer">
    <button class="btn btn-primary" type="submit" id="businessEditSubmit">Submit</button> 
    <button onclick="cc.crud.business.edit.cancel()" class="btn btn-default" type="button">Cancel</button>
  </div>

{!! Form::close() !!}

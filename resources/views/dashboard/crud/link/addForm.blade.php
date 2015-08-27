<!-- form start -->
{!! Form::open(array('role' => 'form', 'name' => 'businessAddForm', 'id' => 'businessAddForm')) !!}

  @include('dashboard.crud.business.form')

  <div class="box-footer">
    <button class="btn btn-primary" type="submit" id="businessAddSubmit">Submit</button> 
    <button onclick="cc.crud.business.add.cancel()" class="btn btn-default" type="button">Cancel</button>
  </div>

{!! Form::close() !!}

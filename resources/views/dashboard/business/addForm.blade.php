<!-- form start -->
{!! Form::open(array('url' => 'business', 'method' => 'post', 'role' => 'form', 'name' => 'businessAddForm', 'id' => 'businessAddForm')) !!}

  @include('dashboard.business.form')

  <div class="box-footer">
    <button class="btn btn-primary" type="submit" id="businessAddSubmit">Submit</button> 
    <button onclick="cc.business.add.cancel()" class="btn btn-default" type="button">Cancel</button>
  </div>

{!! Form::close() !!}

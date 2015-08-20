<!-- form start -->
{!! Form::open(array('url' => 'business/@{{id}}', 'method' => 'post', 'role' => 'form', 'name' => 'businessEditForm', 'id' => 'businessEditForm')) !!}

  <input type="hidden" name="id" id="id" value="@{{id}}">

  @include('dashboard.business.form')

  <div class="box-footer">
    <button class="btn btn-primary" type="submit" id="businessEditSubmit">Submit</button> 
    <button onclick="cc.business.edit.cancel()" class="btn btn-default" type="button">Cancel</button>
  </div>

{!! Form::close() !!}

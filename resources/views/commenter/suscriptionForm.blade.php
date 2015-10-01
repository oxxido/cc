{!! Form::open(array('url'=>url('commenter'),'role' => 'form', 'name' => 'commenterForm', 'id' => 'commenterForm')) !!}

  <input type="hidden" name="commenter_id" value="{{ $commenter->id }}">

  @if (count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  <div class="form-group">
      <input type="checkbox" name="suscribe_all" id="suscribe_all" value="1" @if($commenter->mail_suscribe) checked="checked" @endif>
      <label for="suscribe_all" >Suscribe to all plataform mails</label>
  </div>

  <div class="form-group">
      <fieldset>
        <label for="businesses">Businesses Admin</label>
        <select name="businesses" class="form-control">
          @foreach ($business_commenter as $biz)
            <option value=$biz->id>$biz->id</option>
          @endforeach
        </select>

        <input type="checkbox" name="suscribe_biz" id="suscribe_biz" value="1" @if($business_commenter->mail_suscribe) checked="checked" @endif>
        <label for="suscribe_biz" >Suscribe to all business mails</label>
      </fieldset>
  </div>

  <p class="text-center">
      <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Save Settings</button>
  </p>
{!! Form::close() !!}

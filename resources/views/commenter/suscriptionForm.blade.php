{!! Form::open(array('url'=>url('commenter/suscription'),'role' => 'form', 'name' => 'commenterForm', 'id' => 'commenterForm')) !!}

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
        <label for="businesses">Business to configure mail suscription</label>
        <select name="businesses" id="businesses" class="form-control">
          @foreach ($business_commenter as $biz)
            <option value="{{ $biz->id }}"> {{ $biz->business->name }}</option>
          @endforeach
        </select>

          <hr>
          <div class="overlay" id="linkTableLoading">
            <i class="fa fa-refresh fa-spin"></i>
          </div>

          <label>Check the type of mail you want to suscribe</label>
          <div id="biz_suscriptions">
            <!--
            biz_commenter->mail_suscribe checkbox for selected biz

            <br>Check the type of mail you want to suscribe<br>
            foreach of mailSuscribes checkboxes for selected biz
            -->
          </div>
        
      </fieldset>
  </div>

  <p class="text-center">
      <button type="submit" class="btn btn-warning"></span> Save Settings</button>
  </p>
{!! Form::close() !!}

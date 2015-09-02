<div class="box-body">
  <div>
    <ul class="nav nav-tabs">
      <li class="active">
        <a>Social Network Profile</a>
      </li>
    </ul>
  </div>
  <div class="panel panel-default">
    <div class="panel-body">
      Choose a review profile that you would like to display from the dropdown and enter your username to build the url, you'll see the preview below
      <p></p>

      <div class="form-group">
        <div class="row">
          <div class="col-sm-2 col-xs-1">
            
          </div>
          <div class="col-sm-3 col-xs-5">
            <label for="social_network_id">Social Network</label>
            <select class="form-control" name="social_network_id" placeholder="Enter Social Network" id="social_network_id">

              @foreach ($social_networks as $social_network)
                <option value="{{ $social_network->id }}"> {{ $social_network->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-sm-3 col-xs-5">
            <label for="name">Username</label>
        <input type="text" name="url" placeholder="Enter link to profile page" id="name" class="form-control" value="" required>
        
          </div>
          <div class="col-sm-4  col-xs-1">
          </div>

        </div>
        <div class="row">
        &nbsp;
        </div>
        <div class="row">
          <div class="col-sm-2 col-xs-1">
            
          </div>
          <div class="col-sm-3 col-xs-5">
            <img name="logo" id="logo" src="{{ $social_networks[0]->logo }}" width="50"> 
          </div>
          <div class="col-sm-3 col-xs-5"  style="padding-top:10px;" id="social_result">
            
          </div>
          <div class="col-sm-4  col-xs-1">
          </div>

        </div>
        
      </div>

      <div class="form-group">
        
        <!--<input name="active" type="checkbox">Show URL in Testimonials Widget and on thank-you page-->
        <br>
        
       
      </div>
                  
    </div>
  </div>
  
</div><!-- /.box-body -->

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
      Choose each review profile that you would like to display from the drop down and then press "Add rofile" button. You can drag to re-order them too!
      <p></p>

      <div class="form-group">
        <label for="social_network_id">Social Network</label>
        <select class="form-control" name="social_network_id" placeholder="Enter Social Network" id="social_network_id">
          <option></option>
          @foreach ($social_networks as $social_network)
            <option value="{{ $social_network->logo }}">{{ $social_network->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <img name="logo" id="logo" src="{{ $social_network->logo }}" width="50"> 
        <input type="checkbox">Show URL in Testimonials Widget and on thank-you page
        <br>
        
        <label for="name"></label>
        <input type="text" name="name" placeholder="Enter link to {{ $social_network->name }} profile page" id="name" class="form-control" value="" required>
        <br>
        
        <input type="button" value="Visit URL" onclick="">
      </div>
                  
    </div>
  </div>
  
</div><!-- /.box-body -->

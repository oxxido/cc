{!! Form::open(array('url'=>url('widget/feedback'),'role' => 'form', 'name' => 'feedbackForm', 'id' => 'feedbackForm')) !!}

  <input type="hidden" name="product_id" value="{{ $product->id }}">

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
      <label for="firstname">How likely is it that you would recommend our company to a friend or colleague?</label>
      <div class="silver-bg" style="text-align: center">
        <input id="rating" name="rating" type="text" class="rating" size="lg" data-show-clear="false" data-show-caption="false" @if(old('rating')) value="{{ old('rating') }}" @else value="5" @endif>
      </div>
  </div>
  <div class="form-group">
      <label for="first_name">Your First Name</label>
      <input type="text" class="form-control small-width" name="first_name" id="first_name" placeholder="First Name" @if(old('rating')) value="{{ old('first_name') }}"  @elseif($user)  value="{{ $user->first_name }}" @endif required>
  </div>
  <div class="form-group">
      <label for="last_name">Your Last Name</label>
      <input type="text" class="form-control small-width" name="last_name" id="last_name" placeholder="Last Name" @if(old('rating')) value="{{ old('last_name') }}"  @elseif($user)  value="{{ $user->last_name }}" @endif required>
  </div>
  <div class="form-group">
      <label for="email">Your Email</label>
      <input type="email" class="form-control small-width" name="email" id="email" placeholder="Email" @if(old('rating')) value="{{ old('email') }}"  @elseif($user)  value="{{ $user->email }}" @endif required>
  </div>

  @if($config->feedback->include_phone)
    <div class="form-group">
        <label for="phone">Your Phone</label>
        <input type="text" class="form-control small-width" name="phone" id="phone" placeholder="Phone" @if(old('rating')) value="{{ old('phone') }}"  @elseif($user->commenter)  value="{{ $user->commenter->phone }}" @endif required>
    </div>
  @endif

  <div class="form-group">
      <label for="comment">How did you feel about your experience with us?</label>
      <div class="textarea-cnt">
          <textarea class="form-control noresize" rows="3" name="comment" id="comment" placeholder="Write comments here..." required>{{ old('comment') }}</textarea>
          <p class="max-chars">0 / 500 characters maximum</p>
      </div>
  </div>
  <p class="text-center">
      <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Submit Feedback</button>
  </p>
{!! Form::close() !!}
<p class="text-center">By submitting this feedback you agree to our <a href="#"><strong>feedback and review policy</strong></a></p>

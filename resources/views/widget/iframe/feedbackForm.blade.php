@if(Auth::user())
  <h4>Hi {{ $user->name }}!</h4>
@else
  <h4>Your Feedback</h4>
@endif

{!! Form::open(array('url'=>url('widget/feedback/iframe'),'role' => 'form', 'name' => 'feedbackForm', 'id' => 'feedbackForm')) !!}

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
      <div class="text-center">
        <input id="rating" name="rating" type="text" class="rating" size="lg" data-show-clear="false" data-show-caption="false" @if(old('rating')) value="{{ old('rating') }}" @else value="5" @endif>
      </div>
  </div>
  @if(!Auth::user())
    <div class="form-group">
        <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
    </div>
    <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
    </div>

    @if($config->feedback->include_phone)
      <div class="form-group">
          <input type="tel" class="form-control" name="phone" placeholder="Phone" value="{{ old('phone') }}" required>
      </div>
    @endif
  @endif

  <div class="form-group">
      <div>
          <textarea class="form-control noresize" rows="3" name="comment" placeholder="How did you feel about your experience with us?" required>{{ old('comment') }}</textarea>
          <small>0 / 500 characters maximum</small>
      </div>
  </div>
  <p class="text-center">
      <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Submit Feedback</button>
  </p>
{!! Form::close() !!}

<p class="text-center"><small>By submitting you agree to our <a href="#"><strong>feedback and review policy</strong></a></small></p>

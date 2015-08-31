@extends('widget.layout')

@section('content')
  <div class="top-section">
      <p class="title-section">Your Feedback</p>
  </div>
  <div class="bottom-section">
      {!! Form::open(array('role' => 'form', 'name' => 'adminEditForm', 'id' => 'adminEditForm')) !!}

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
                <input id="rate" type="number" class="rating" size="lg" data-show-clear="false" data-show-caption="false" value="5">
              </div>
              <!--
              <div class="silver-bg">
                  <div class="radios-cnt clearfix">
                      <div class="radio">
                          <label><input type="radio" name="rating" id="rating1" value="1" @if (old('rating') == 1) checked="checked" @endif></label>
                          <p>1</p>
                      </div>
                      <div class="radio">
                          <label><input type="radio" name="rating" id="rating2" value="2" @if (old('rating') == 2) checked="checked" @endif></label>
                          <p>2</p>
                      </div>
                      <div class="radio">
                          <label><input type="radio" name="rating" id="rating3" value="3" @if (old('rating') == 3) checked="checked" @endif></label>
                          <p>3</p>
                      </div>
                      <div class="radio">
                          <label><input type="radio" name="rating" id="rating4" value="4" @if (old('rating') == 4) checked="checked" @endif></label>
                          <p>4</p>
                      </div>
                      <div class="radio">
                          <label><input type="radio" name="rating" id="rating5" value="5" @if (old('rating') == 5) checked="checked" @endif></label>
                          <p>5</p>
                      </div>
                      <div class="radio">
                          <label><input type="radio" name="rating" id="rating6" value="6" @if (old('rating') == 6) checked="checked" @endif></label>
                          <p>6</p>
                      </div>
                      <div class="radio">
                          <label><input type="radio" name="rating" id="rating7" value="7" @if (old('rating') == 7) checked="checked" @endif></label>
                          <p>7</p>
                      </div>
                      <div class="radio">
                          <label><input type="radio" name="rating" id="rating8" value="8" @if (old('rating') == 8) checked="checked" @endif></label>
                          <p>8</p>
                      </div>
                      <div class="radio">
                          <label><input type="radio" name="rating" id="rating9" value="9" @if (old('rating') == 9) checked="checked" @endif></label>
                          <p>9</p>
                      </div>
                      <div class="radio">
                          <label><input type="radio" name="rating" id="rating10" value="10" @if ((old('rating') == 10) || !old('rating')) checked="checked" @endif></label>
                          <p>10</p>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-xs-4">Not at all likely</div>
                      <div class="col-xs-4 text-center">Neutral</div>
                      <div class="col-xs-4 text-right">Very likely</div>
                  </div>
              </div> -->
          </div>

          <div class="form-group">
              <label for="first_name">Your First Name</label>
              <input type="text" class="form-control small-width" name="first_name" id="first_name" placeholder="First Name" value="{{ old('first_name') }}">
          </div>
          <div class="form-group">
              <label for="last_name">Your Last Name</label>
              <input type="text" class="form-control small-width" name="last_name" id="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
          </div>
          <div class="form-group">
              <label for="email">Your Email</label>
              <input type="email" class="form-control small-width" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
          </div>
          <div class="form-group">
              <label for="comment">How did you feel about your experience with us?</label>
              <div class="textarea-cnt">
                  <textarea class="form-control" rows="3" name="comment" id="comment" placeholder="Write comments here...">{{ old('comment') }}</textarea>
                  <p class="max-chars">0 / 500 characters maximum</p>
              </div>
          </div>
          <p class="text-center">
              <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Submit Feedback</button>
          </p>
      {!! Form::close() !!}
      <p class="text-center">By submitting this feedback you agree to our <a href="#"><strong>feedback and review policy</strong></a></p>

  </div>
@endsection

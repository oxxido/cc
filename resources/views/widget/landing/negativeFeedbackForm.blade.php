{!! Form::open(array('url'=>url('widget/refeedback/landing'),'role' => 'form', 'name' => 'negativeFeedbackForm', 'id' => 'negativeFeedbackForm')) !!}

  <input type="hidden" id="comment_id" name="comment_id" value="{{ $comment->id }}">

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
      <label for="comment">What could we have done to make your experience better?</label>
      <div class="textarea-cnt">
          <textarea class="form-control noresize" rows="3" name="comment" id="comment" placeholder="Write comments here..." required>{{ old('comment') }}</textarea>
          <p class="max-chars">0 / 500 characters maximum</p>
      </div>
  </div>
  <p class="text-center">
      <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Submit Feedback</button>
  </p>
{!! Form::close() !!}
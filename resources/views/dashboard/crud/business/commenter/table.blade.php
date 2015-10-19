@if($commenters_page->isEmpty())
  <i>There are no customers set for this business</i>
@else
  <table id="businessesTable" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Added by</th>
        <th>Acount</th>
        <th>Requests</th>
        <th>Review</th>
        <th width="65">Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($commenters_page as $commenter)
      <?php $business_commenter = $commenter->businessCommenter($business->id) ?>
      <tr>
        <td>
          {{ $commenter->name }}
        </td>
        <td>
          {!! (null !== ($adder = App\Models\User::find($commenter->pivot->adder_id)))? $adder->name: '<div class="text-center">-</div>' !!}
        </td>
        <td class="text-center">
          @if($commenter->user->active)
            <span class="fa fa-check-circle-o fa-color-info" title="Account active">
          @else
            <span class="fa fa-circle-o fa-color-danger" title="Account not activated">
          @endif
        </td>
        <td class="text-right">
          {{ $commenter->pivot->feedback_requests_sent }}
        </td>
        <td style="width: 110px;">
          @if($business_commenter->review !== NULL)
            <input type="text" class="rating" data-size="xxs" data-show-clear="false" data-show-caption="false" value="{{ $business_commenter->review }}">
          @endif
        </td>
        <td class="action">
          <a href="#" class="commenter-remove" data-uuid="{{ $commenter->uuid }}" data-name="{{ $commenter->name }}" title="Delete Customer">
            <span class="glyphicon glyphicon-remove link" aria-hidden="true"></span>
          </a>
          @if($business_commenter->review === NULL)
            <a href="#" class="commenter-request" data-uuid="{{ $commenter->uuid }}" data-name="{{ $commenter->name }}" title="Send Feedback Request">
              <span class="fa fa-mail-forward" aria-hidden="true"></span>
            </a>
          @else
            <span class="disabled fa fa-mail-forward" aria-hidden="true" title="Send Feedback Request"></span>
          @endif
          <a href="#" class="commenter-status" data-uuid="{{ $commenter->uuid }}" title="Show on website">
            <span class="fa fa-thumbs-o-up" aria-hidden="true"></span>
          </a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>

  <nav>
    {!! $commenters_page->render() !!}
  </nav>
@endif

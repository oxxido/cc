@extends('dashboard.business.layout')

@section('form')

  <h3>Customers list</h3>
  <p>This is the list of available customers for this business</p>
  <br>

  <div class="box box-success box-solid collapse in" id="commenters_table">
    <div class="box-header">
      <a href="{{ URL::route('business.commenter.create', $business) }}" class="btn btn-app">
        <i class="fa fa-plus"></i> Add Customer
      </a>
    </div>
    <div class="box-body">
      @include('dashboard.crud.business.commenter.table', [$business, 'commenters_page' => $business->commenters()->paginate()])
    </div>
  </div>
@endsection

@section('footer')
  
  @parent

  <script type="text/javascript" src="/js/cc.crud.business.commenter.js"></script>

  <script type="text/javascript">
    $(function () {
      cc.crud.business.commenter.business_uuid = "{{ $business->uuid }}";
      cc.crud.business.commenter.init();
    });
  </script>
@endsection

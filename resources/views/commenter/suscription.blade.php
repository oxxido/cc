@extends('commenter.layout')

@section('content')
  <div class="top-section">
      <p class="title-section">Phone Number: {{ $commenter->phone }}</p>
  </div>
  <div class="bottom-section">

    @include('commenter.suscriptionForm')

  </div>
@endsection

@section('foot')
	<script type="text/javascript" src="{{ asset('/js/cc.dashboard.js') }}"></script>
	<script type="text/javascript" src="/js/cc.suscription.js"></script>
	<script type="text/javascript">
	var bizCommenters = {!! json_encode($business_commenter) !!};
	var mailBizSuscribes = {!! json_encode($mail_suscribe) !!};

    $(function () {
      cc.suscription.init();
    });
  </script>
@endsection
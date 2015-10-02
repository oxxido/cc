@extends('dashboard.crud.layout')

@section('title')
    <section class="content-header">
        <h1>
            Business <i>{{ $business->name }}</i>: Customers list
            <small>This is the list of available customers for this business</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Business</a></li>
            <li class="active">Customers</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="box collapse in" id="commenters_table">
        <div class="box-header with-border">
            <a href="{{ URL::route('business.commenter.create', $business) }}" class="btn btn-app">
                <i class="fa fa-plus"></i> Add Customer
            </a>
            @include('dashboard.crud.business.commenter.table', [$business, 'commenters_page' => $business->commenters()->paginate()])
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript" src="/js/cc.crud.business.commenter.js"></script>

    <script type="text/javascript">
        $(function () {
            cc.crud.business.commenter.business_uuid = "{{ $business->uuid }}";
            cc.crud.business.commenter.init();
        });
    </script>
@endsection

@extends('layouts.main')

@section('body')
  <section class="top-page">
    <div class="wrapper">
      <div class="row logo-title-cnt">
        <div class="col-xs-6">
          <div class="title-cnt">
            Mail Unsuscriptions
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="feedback">
    <div class="wrapper">
      <div class="bg-panel">
        <div class="top-section">
            <p class="title-section">{{ $commenter->name }} - {{ $commenter->email }}</p>
        </div>
        <div class="bottom-section">

          {!! Form::open(array('url'=>url('suscription'),'role' => 'form', 'name' => 'commenterForm', 'id' => 'commenterForm')) !!}

            <input type="hidden" name="commenter_id" value="{{ $commenter->id }}">

            <div class="form-group">
              <input type="checkbox" name="unsuscribe_all" id="unsuscribe_all" value="1" @if($commenter->mail_unsuscribe) checked="checked" @endif>
              <label for="unsuscribe_all">Unsuscribe from all plataform emails</label>
            </div>

            <div class="form-group">
              <label for="businesses">Select a Business to configure email unsuscription</label>
              <select name="businesses" id="businesses" class="form-control">
                <option value="0" selected="true">Select a business</option>
                @foreach ($business_commenter as $biz)
                  <option value="{{ $biz->business_id }}"> {{ $biz->business->name }}</option>
                @endforeach
              </select>
            </div>
            <div id="biz_suscriptions">
              <p>Check the type of email you want to unsuscribe</p>
              <div class="form-group">
                <input type="checkbox" name="unsuscribe_biz" id="unsuscribe_biz" value="1" disabled="disabled">
                <label for="unsuscribe_biz" >Unsuscribe from all business emails</label>
              </div>
              <blockquote>
                <div class="form-group">
                  <input type="checkbox" name="mail1" id="mail1" value="1" disabled="disabled">
                  <label for="mail1" >Unsuscribe from "Feedback request" emails</label>
                </div>
                <div class="form-group">
                  <input type="checkbox" name="mail2" id="mail2" value="1" disabled="disabled">
                  <label for="mail2" >Unsuscribe from "Thank you feedback" emails</label>
                </div>
              </blockquote>
            </div>

            <p class="text-center">
              <button type="submit" class="btn btn-warning"></span> Save Settings</button>
            </p>
          {!! Form::close() !!}

        </div>
      </div>
    </div>
  </section>
@endsection


@section('footer')
  <script type="text/javascript" src="{{ asset('/js/tools.js') }}"></script>
  <script type="text/javascript" src="/js/cc.suscription.js"></script>
  <script type="text/javascript">
    var bizCommenters = {!! json_encode($business_commenter) !!};
    var mailBizSuscribes = {!! json_encode($mail_suscribe) !!};

    $(function () {
      cc.suscription.init();
    });
  </script>
@endsection

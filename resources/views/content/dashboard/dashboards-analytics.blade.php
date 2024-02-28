@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-analytics.css')}}">
@endsection

@section('vendor-script')
  <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
  <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-8 mb-4 order-0">
      @include('content.dashboard._partials.welcome')
    </div>

    <div class="col-sm-4 col-lg-2 mb-4">
      @include('content.dashboard._partials.total-customers')
    </div>

    <div class="col-sm-4 col-lg-2 mb-4">
      @include('content.dashboard._partials.total-orders')
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-lg-8 mb-4">
      @include('content.dashboard._partials.revenue.total')
    </div>

    <div class="col-12 col-xl-4 col-md-6">
      @include('content.dashboard._partials.revenue.total-sports')
    </div>
  </div>

  <div class="row">
      <div class="col-12 col-xl-4 col-md-6">
          @include('content.dashboard._partials.bestselling-products')
      </div>

      <div class="col-12 col-xl-4 col-md-6">
        @include('content.dashboard._partials.bestselling-services')
      </div>

      <div class="col-12 col-xl-4 col-md-6">
        @include('content.dashboard._partials.top-customes')
      </div>
  </div>
@endsection

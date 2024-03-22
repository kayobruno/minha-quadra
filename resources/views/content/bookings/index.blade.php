@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Reservas')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-calendar.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/bookings/index.css') }}" />  
@endsection

@section('content')

<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Reservas /</span> Listagem
</h4>

@include('_partials.alerts')
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card app-calendar-wrapper">
      <div class="row g-0">

        <div class="col app-calendar-content">
          <div class="card shadow-none border-0">
            <div class="card-body pb-0">
              <div id="calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-standard"></div>
            </div>
          </div>

          <div class="app-overlay"></div>

          @include('content.bookings._partials.form-modal')
        </div>
      </div>
    </div>
  </div>

@endsection

@section('vendor-script')
  <script src="{{ asset('assets/js/bookings/index.js') }}"></script>
@endsection

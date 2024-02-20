@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Cadastro de Reserva')

@section('content')

  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Reservas /</span> Cadastro
  </h4>

  <div class="row">
    <form action="{{ route('bookings.store') }}" class="form" method="POST">
      @include('content.bookings._partials.form')
    </form>
  </div>

@endsection

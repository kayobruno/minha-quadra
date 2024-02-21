@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Atualização de Reserva')

@section('content')

  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Reservas /</span> Atualização
  </h4>

  <div class="row">
    <form action="{{ route('bookings.update', $booking) }}" class="form" method="POST">
      @method('PUT')
      @include('content.bookings._partials.form')
    </form>
  </div>

@endsection

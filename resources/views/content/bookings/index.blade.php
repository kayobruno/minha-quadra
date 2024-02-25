@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Reservas')

@section('content')

<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Reservas /</span> Listagem
</h4>

@include('_partials.alerts')

<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header">
    <a class="btn btn-primary me-2" href="{{ route('bookings.create') }}">
      <i class='bx bxs-add-to-queue'></i> Cadastrar
    </a>
  </h5>
  <div class="table-responsive text-nowrap">
    @if(!empty($bookings) && count($bookings))
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Quadra</th>
            <th>Modalidade</th>
            <th>Data do Agendamento</th>
            <th>Status</th>
            <th>Agendado Por</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody class="table-border-bottom-0">
          @foreach ($bookings as $booking)
          <tr>
            <td>{{ $booking->id }}</td>
            <td>{{ $booking->customer->name }}</td>
            <td>{{ $booking->court->name }}</td>
            <td>{!! $booking->sport->tag() !!}</td>
            <td>{{ $booking->start_datetime->format('d/m/Y H:i') }} até {{ $booking->end_datetime->format('H:i') }}</td>
            <td>{!! $booking->status->tag() !!}</td>
            <td>{{ $booking->user?->name }}</td>
            <td>
              @if($booking->status->isEditable())
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('bookings.edit', $booking) }}"><i class="bx bx-edit-alt me-1"></i> Editar</a>
                  </div>
                </div>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      {{ $bookings->links('_partials.pagination') }}
    @else
      <br />
      <div class="col-md-8">
        <div class="alert alert-warning" role="alert" style="margin-left: 15px;">
          Nenhuma Reserva cadastrada!
        </div>
      </div>
    @endif
  </div>
</div>
<!--/ Basic Bootstrap Table -->
@endsection

@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Agendamentos')

@section('content')

<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Agendamentos /</span> Listagem
</h4>

@include('_partials.alerts')

<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header">
    <a class="btn btn-primary me-2" href="{{ route('customers.create') }}">
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
            <th>Esporte</th>
            <th>Data do Agendamento</th>
            <th>Status</th>
            <th>Agendado Por</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody class="table-border-bottom-0">
          @foreach ($bookings as $booking)
            @if($booking->customer == null)
              @dd($booking)
            @endif
          <tr>
            <td>{{ $booking->id }}</td>
            <td>{{ $booking->customer->name }}</td>
            <td>{{ $booking->court->name }}</td>
            <td>{!! $booking->sport->tag() !!}</td>
            <td>{{ $booking->when->format('d/m/Y H:i') }}</td>
            <td>{!! $booking->status->tag() !!}</td>
            <td>{{ $booking->user?->name }}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('customers.edit', $booking) }}"><i class="bx bx-edit-alt me-1"></i> Editar</a>

                  <form action="{{ route('customers.delete', $booking) }}" method="POST" style="margin-bottom: 5px;" onsubmit="return confirm('Você realmente quer remover este registro?');">
                    @csrf
                    @method('delete')
                    <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Remover</button>
                  </form>
                </div>
              </div>
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
          Nenhum Agendamento cadastrado!
        </div>
      </div>
    @endif
  </div>
</div>
<!--/ Basic Bootstrap Table -->
@endsection

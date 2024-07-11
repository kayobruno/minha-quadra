@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Pedidos')

@section('content')

<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Pedidos /</span> Listagem
</h4>

@include('_partials.alerts')

<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header">
    <a class="btn btn-primary me-2" href="{{ route('orders.create') }}">
      <i class='bx bxs-add-to-queue'></i> Cadastrar
    </a>
  </h5>
  <div class="table-responsive text-nowrap">
    @if(!empty($orders) && count($orders))
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Comanda</th>
            <th>Status</th>
            <th>Data de Cadastro</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody class="table-border-bottom-0">
          @foreach ($orders as $order)
          <tr>
            <td>{{ $order->id }}</td>
            <td>
              <div class="d-flex justify-content-start align-items-center">
                <div class="avatar-wrapper">
                  <div class="avatar avatar-sm me-2">
                    <span class="avatar-initial rounded-circle bg-label-primary">{{ $order->customer->getInitials() }}</span>
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <a href="{{ route('customers.edit', $order->customer) }}" class="text-body text-truncate">
                    <span class="fw-medium">{{ $order->customer->name }}</span>
                  </a>
                  <small class="text-truncate text-muted">{{ $order->customer->phone }}</small>
                </div>
              </div>
            </td>
            <td><span class="badge badge-center bg-primary"><b>{{ $order->tab ?? '#' }}</b></span></td>
            <td>{!! $order->status->tag() !!}</td>
            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  @if($order->isPaid())
                    <a class="dropdown-item" href=""><i class="bx bx-show mx-1"></i> Visualizar</a>
                  @else
                    <a class="dropdown-item" href=""><i class="bx bx-edit-alt me-1"></i> Editar</a>
                  @endif
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      {{ $orders->links('_partials.pagination') }}
    @else
      <br />
      <div class="col-md-8">
        <div class="alert alert-warning" role="alert" style="margin-left: 15px;">
          Nenhum Pedido cadastrado!
        </div>
      </div>
    @endif
  </div>
</div>
<!--/ Basic Bootstrap Table -->
@endsection

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
    <a class="btn btn-primary me-2" href="">
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
            <th>Total</th>
            <th>Status</th>
            <th>Data de Cadastro</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody class="table-border-bottom-0">
          @foreach ($orders as $order)
          <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->customer->name }}</td>
            <td><span class="badge badge-center bg-primary"><b>{{ $order->tab ?? '#' }}</b></span></td>
            <td>R$ @money($order->total_amount)</td>
            <td>{!! $order->status->tag() !!}</td>
            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href=""><i class="bx bx-edit-alt me-1"></i> Editar</a>
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

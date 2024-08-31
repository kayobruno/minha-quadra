@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Pedidos')

@section('content')

<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Pedidos /</span> Listagem
</h4>

@include('_partials.alerts')

<div class="card mb-4">
  <div class="card-widget-separator-wrapper">
    <div class="card-body card-widget-separator">
      <div class="row gy-4 gy-sm-1">
        <div class="col-sm-6 col-lg-3">
          <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-4 pb-sm-0">
            <div>
              <h4 class="mb-0">56</h4>
              <p class="mb-0">Pendentes</p>
            </div>
            <span class="avatar w-px-40 h-px-40 me-sm-4">
              <span class="avatar-initial bg-label-secondary rounded">
                <i class='bx bx-barcode'></i>
              </span>
            </span>
          </div>
          <hr class="d-none d-sm-block d-lg-none me-6">
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-4 pb-sm-0">
            <div>
              <h4 class="mb-0">12,689</h4>
              <p class="mb-0">Pagos</p>
            </div>
            <span class="avatar w-px-40 h-px-40 p-2 me-lg-4">
              <span class="avatar-initial bg-label-secondary rounded">
                <i class='bx bx-heart'></i>
              </span>
            </span>
          </div>
          <hr class="d-none d-sm-block d-lg-none">
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="d-flex justify-content-between align-items-start border-end pb-4 pb-sm-0 card-widget-3">
            <div>
              <h4 class="mb-0">124</h4>
              <p class="mb-0">Cancelados</p>
            </div>
            <span class="avatar w-px-40 h-px-40 p-2 me-sm-4">
              <span class="avatar-initial bg-label-secondary rounded">
                <i class='bx bx-error'></i>
              </span>
            </span>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="d-flex justify-content-between align-items-start">
            <div>
              <h4 class="mb-0">32</h4>
              <p class="mb-0">Total</p>
            </div>
            <span class="avatar w-px-40 h-px-40 p-2">
              <span class="avatar-initial bg-label-secondary rounded">
                <i class='bx bx-basket'></i>
              </span>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header">
    <a class="btn btn-primary me-2" href="#" data-bs-toggle="modal" data-bs-target="#basicModal">
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

@include('content.orders._partials.modal')

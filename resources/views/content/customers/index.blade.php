@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Clientes')

@section('content')

<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Clientes /</span> Listagem
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
    @if(!empty($customers) && count($customers))
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Data de Cadastro</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody class="table-border-bottom-0">
          @foreach ($customers as $customer)
          <tr>
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->phone }}</td>
            <td>{{ $customer->created_at->format('d/m/Y H:i') }}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('customers.edit', $customer) }}"><i class="bx bx-edit-alt me-1"></i> Editar</a>

                  <form action="{{ route('customers.delete', $customer) }}" method="POST" style="margin-bottom: 5px;" onsubmit="return confirm('Você realmente quer remover este registro?');">
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

      {{ $customers->links('_partials.pagination') }}
    @else
      <br />
      <div class="col-md-8">
        <div class="alert alert-warning" role="alert" style="margin-left: 15px;">
          Nenhum Cliente cadastrado!
        </div>
      </div>
    @endif
  </div>
</div>
<!--/ Basic Bootstrap Table -->
@endsection

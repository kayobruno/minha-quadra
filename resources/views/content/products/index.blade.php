@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Produtos')

@section('content')
  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Produtos /</span> Listagem
  </h4>

  @include('_partials.alerts')

  <div class="card">
    <h5 class="card-header">
      <a class="btn btn-primary me-2" href="{{ route('products.create') }}">
        <i class='bx bxs-add-to-queue'></i> Cadastrar
      </a>
    </h5>
    <div class="table-responsive text-nowrap">
      @if(!empty($products) && count($products))
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Nome</th>
              <th>Preço</th>
              <th>Estoque</th>
              <th>Status</th>
              <th>Ações</th>
            </tr>
          </thead>

          <tbody class="table-border-bottom-0">
            @foreach ($products as $product)
            <tr>
              <td>{{ $product->id }}</td>
              <td>{{ $product->name }}</td>
              <td>R$ @money($product->price)</td>
              <td>{{ $product->stock }}</td>
              <td>{!! App\Enums\Status::from($product->status)->tag() !!}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('products.edit', $product) }}"><i class="bx bx-edit-alt me-1"></i> Editar</a>

                    <form action="{{ route('products.delete', $product) }}" method="POST" style="margin-bottom: 5px;" onsubmit="return confirm('Você realmente quer remover este registro?');">
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

        {{ $products->links('_partials.pagination') }}
      @else
        <br />
        <div class="col-md-8">
          <div class="alert alert-warning" role="alert" style="margin-left: 15px;">
            Nenhum Produto cadastrado!
          </div>
        </div>
      @endif
    </div>
  </div>
@endsection

@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Quadras')

@section('content')
  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Quadras /</span> Listagem
  </h4>

  @include('_partials.alerts')

  <div class="card">
    <h5 class="card-header">
      <a class="btn btn-primary me-2" href="{{ route('courts.create') }}">
        <i class='bx bxs-add-to-queue'></i> Cadastrar
      </a>
    </h5>
    <div class="table-responsive text-nowrap">
      @if(!empty($courts) && count($courts))
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Nome</th>
              <th>Cor</th>
              <th>Ações</th>
            </tr>
          </thead>

          <tbody class="table-border-bottom-0">
            @foreach ($courts as $court)
            <tr>
              <td>{{ $court->id }}</td>
              <td>{{ $court->name }}</td>
              <td>
                <div class="avatar avatar-sm me-3">
                  <span class="avatar-initial rounded-circle" style="background-color: {{ $court->color }}"></span>
                </div>
              </td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('courts.edit', $court) }}"><i class="bx bx-edit-alt me-1"></i> Editar</a>

                    <form action="{{ route('courts.delete', $court) }}" method="POST" style="margin-bottom: 5px;" onsubmit="return confirm('Você realmente quer remover este registro?');">
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

        {{ $courts->links('_partials.pagination') }}
      @else
        <br />
        <div class="col-md-8">
          <div class="alert alert-warning" role="alert" style="margin-left: 15px;">
            Nenhuma Quadra cadastrada!
          </div>
        </div>
      @endif
    </div>
  </div>
@endsection

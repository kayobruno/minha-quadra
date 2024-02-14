@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Atualização de Fornecedor')

@section('content')

  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Fornecedores /</span> Atualização
  </h4>

  <div class="row">
    <form action="{{ route('suppliers.update', $supplier) }}" class="form" method="POST">
      @method('PUT')
      @include('content.suppliers._partials.form')
    </form>
  </div>

@endsection

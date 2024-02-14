@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Cadastro de Fornecedor')

@section('content')

  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Fornecedores /</span> Cadastro
  </h4>

  <div class="row">
    <form action="{{ route('suppliers.store') }}" class="form" method="POST">
      @include('content.suppliers._partials.form')
    </form>
  </div>

@endsection

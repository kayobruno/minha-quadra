@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Cadastro de Produto')

@section('content')

  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Produtos /</span> Cadastro
  </h4>

  <div class="row">
    <form action="{{ route('products.store') }}" class="form" method="POST" enctype="multipart/form-data">
      @include('content.products._partials.form')
    </form>
  </div>

@endsection

@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Atualização de Produto')

@section('content')

  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Produtos /</span> Atualização
  </h4>

  <div class="row">
    <form action="{{ route('products.update', $product) }}" class="form" method="POST" enctype="multipart/form-data">
      @method('PUT')
      @include('content.products._partials.form')
    </form>
  </div>

@endsection

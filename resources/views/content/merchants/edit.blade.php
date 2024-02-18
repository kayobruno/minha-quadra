@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Atualização dos dados da minha empresa')

@section('content')

  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Minha Empresa /</span> Atualização
  </h4>

  <div class="row">
    <form action="{{ route('mymerchant.update', $merchant) }}" class="form" method="POST">
      @method('PUT')
      @include('content.merchants._partials.form')
    </form>
  </div>

@endsection

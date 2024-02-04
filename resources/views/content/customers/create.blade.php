@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Cadastro de Cliente')

@section('content')

  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Clientes /</span> Cadastro
  </h4>

  <div class="row">
    <form action="{{ route('customers.store') }}" class="form" method="POST">
      @include('content.customers._partials.form')
    </form>
  </div>

@endsection

@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Atualização de Cliente')

@section('content')

  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Clientes /</span> Atualização
  </h4>

  <div class="row">
    <form action="{{ route('customers.update', $customer) }}" class="form" method="POST">
      @method('PUT')
      @include('content.customers._partials.form')
    </form>
  </div>

@endsection

@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Cadastro de Quadra')

@section('content')

  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Quadras /</span> Cadastro
  </h4>

  <div class="row">
    <form action="{{ route('courts.store') }}" class="form" method="POST">
      @include('content.courts._partials.form')
    </form>
  </div>

@endsection

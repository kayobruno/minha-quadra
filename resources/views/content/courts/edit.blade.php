@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Atualização da Quadra')

@section('content')

  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Quadra /</span> Atualização
  </h4>

  <div class="row">
    <form action="{{ route('courts.update', $court) }}" class="form" method="POST">
      @method('PUT')
      @include('content.courts._partials.form')
    </form>
  </div>

@endsection

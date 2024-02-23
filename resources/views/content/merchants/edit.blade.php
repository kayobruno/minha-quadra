@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Atualização dos dados da minha empresa')

@section('content')

  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Minha Empresa /</span> Atualização
  </h4>

  <div class="row">

    <div class="nav-align-top">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">Informações da Empresa</button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">Horário de Funcionamento</button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-messages" aria-controls="navs-top-messages" aria-selected="false">Configurações das Reservas</button>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
          <form action="{{ route('mymerchant.update', $merchant) }}" class="form" method="POST">
            @method('PUT')
            @include('content.merchants._partials.form')
          </form>
        </div>
        <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
          <div class="alert alert-info col-md-6" role="alert">
            Deixe os valores em branco para os dias que o estabelecimento <b>não funcionar</b>.
          </div>

          <form action="{{ route('mymerchant.update', $merchant) }}" class="form" method="POST">
            @method('PUT')
            @include('content.merchants._partials.form-business-hours')
          </form>
        </div>
        <div class="tab-pane fade" id="navs-top-messages" role="tabpanel">
          <p></p>
        </div>
      </div>
    </div>
  </div>

@endsection

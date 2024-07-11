@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Cadastro de Faturas')

@section('content')

    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Faturas /</span> Cadastro
    </h4>

    <div class="row">
        <form action="#" class="form" enctype="multipart/form-data">
            @include('content.invoices._partials.form')
        </form>
    </div>

@endsection

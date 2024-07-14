@extends('layouts/contentNavbarLayout')

@section('title', 'Set Reserve - Faturas')

@section('content')

    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Faturas /</span> Listagem
    </h4>

    <div class="card">
        <h5 class="card-header">
            <a class="btn btn-primary me-2" href="{{ route('invoices.create') }}">
                <i class='bx bxs-add-to-queue'></i> Cadastrar
            </a>
        </h5>
    </div>

    @include('_partials.alerts')

@endsection

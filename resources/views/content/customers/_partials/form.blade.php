@csrf
<div class="col-md-6">
  <div class="card mb-4">
    <div class="card-body">
      <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nome" required value="{{ $customer?->name ?? old('name') }}" autocomplete="given-name" />
      </div>

      <div class="mb-3">
        <label for="phone" class="form-label">Telefone</label>
        <input class="form-control" type="text" id="phone" name="phone" placeholder="(99) 9 9999-9999" value="{{ $customer?->phone ?? old('phone') }}" autocomplete="tel" />
      </div>

      <div class="mb-3">
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Voltar</a>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>

      @include('_partials.alerts')
    </div>
  </div>
</div>

@section('page-script')
  <script src="{{ asset('assets/vendor/libs/jquery-mask/jquery.mask.min.js') }}"></script>
  <script>
    jQuery(document).ready(function ($) {
      $('#phone').mask('(99) 9 9999-9999');
    });
  </script>
@endsection

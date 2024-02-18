@csrf
<div class="col-md-6">
  <div class="card mb-4">
    <div class="card-body">
      <div class="mb-3">
        <label for="trade_name" class="form-label">Razão Social</label>
        <input type="text" class="form-control" id="trade_name" name="trade_name" placeholder="Razão Social" required value="{{ $merchant?->trade_name ?? old('trade_name') }}" autocomplete="given-name" />
      </div>

      <div class="mb-3">
        <label for="document" class="form-label">CNPJ</label>
        <input type="text" class="form-control" id="document" name="document" placeholder="00.000.000/0000-00" disabled value="{{ $merchant?->document ?? old('document') }}" />
      </div>

      <div class="mb-3">
        <label for="phone" class="form-label">Telefone</label>
        <input class="form-control" type="text" id="phone" name="phone" placeholder="(99) 9 9999-9999" value="{{ $merchant?->phone ?? old('phone') }}" autocomplete="tel" />
      </div>

      <div class="mb-3">
        <label for="address" class="form-label">Endereço</label>
        <input class="form-control" type="text" id="address" name="address" placeholder="Endereço" value="{{ $merchant?->address ?? old('address') }}" />
      </div>

      <div class="mb-3">
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
      $('#document').mask('00.000.000/0000-00', {reverse: true});
      $('#phone').mask('(99) 9 9999-9999');
    });
  </script>
@endsection


@csrf
<div class="col-md-6">
  <div class="card mb-4">
  <div class="card-body">
    <div class="input-group mb-3">
    <span class="input-group-text">Segunda-feira</span>
    <input type="text" aria-label="Abertura" class="form-control field-time" placeholder="Abertura" name="business_hours[monday][open]" value="{{ $merchant?->business_hours['monday']['open'] ?? old('business_hours[monday][open]') }}">
    <input type="text" aria-label="Fechamento" class="form-control field-time" placeholder="Fechamento" name="business_hours[monday][close]" value="{{ $merchant?->business_hours['monday']['close'] ?? old('business_hours[monday][close]') }}">
    </div>

    <div class="input-group mb-3">
    <span class="input-group-text">Terça-feira</span>
    <input type="text" aria-label="Abertura" class="form-control field-time" placeholder="Abertura" name="business_hours[tuesday][open]" value="{{ $merchant?->business_hours['tuesday']['open'] ?? old('business_hours[tuesday][open]') }}">
    <input type="text" aria-label="Fechamento" class="form-control field-time" placeholder="Fechamento" name="business_hours[tuesday][close]" value="{{ $merchant?->business_hours['tuesday']['close'] ?? old('business_hours[tuesday][close]') }}">
    </div>

    <div class="input-group mb-3">
    <span class="input-group-text">Quarta-feira</span>
    <input type="text" aria-label="Abertura" class="form-control field-time" placeholder="Abertura" name="business_hours[wednesday][open]"  value="{{ $merchant?->business_hours['wednesday']['open'] ?? old('business_hours[wednesday][open]') }}">
    <input type="text" aria-label="Fechamento" class="form-control field-time" placeholder="Fechamento" name="business_hours[wednesday][close]" value="{{ $merchant?->business_hours['wednesday']['close'] ?? old('business_hours[wednesday][close]') }}">
    </div>

    <div class="input-group mb-3">
    <span class="input-group-text">Quinta-feira</span>
    <input type="text" aria-label="Abertura" class="form-control field-time" placeholder="Abertura" name="business_hours[thursday][open]" value="{{ $merchant?->business_hours['thursday']['open'] ?? old('business_hours[thursday][open]') }}">
    <input type="text" aria-label="Fechamento" class="form-control field-time" placeholder="Fechamento" name="business_hours[thursday][close]" value="{{ $merchant?->business_hours['thursday']['close'] ?? old('business_hours[thursday][close]') }}">
    </div>

    <div class="input-group mb-3">
    <span class="input-group-text">Sexta-feira</span>
    <input type="text" aria-label="Abertura" class="form-control field-time" placeholder="Abertura" name="business_hours[friday][open]" value="{{ $merchant?->business_hours['friday']['open'] ?? old('business_hours[friday][open]') }}">
    <input type="text" aria-label="Fechamento" class="form-control field-time" placeholder="Fechamento" name="business_hours[friday][close]" value="{{ $merchant?->business_hours['friday']['close'] ?? old('business_hours[friday][close]') }}">
    </div>

    <div class="input-group mb-3">
    <span class="input-group-text">Sábado</span>
    <input type="text" aria-label="Abertura" class="form-control field-time" placeholder="Abertura" name="business_hours[saturday][open]" value="{{ $merchant?->business_hours['saturday']['open'] ?? old('business_hours[saturday][open]') }}">
    <input type="text" aria-label="Fechamento" class="form-control field-time" placeholder="Fechamento" name="business_hours[saturday][close]" value="{{ $merchant?->business_hours['saturday']['close'] ?? old('business_hours[saturday][close]') }}">
    </div>

    <div class="input-group mb-3">
    <span class="input-group-text">Domingo</span>
    <input type="text" aria-label="Abertura" class="form-control field-time" placeholder="Abertura" name="business_hours[sunday][open]" value="{{ $merchant?->business_hours['sunday']['open'] ?? old('business_hours[sunday][open]') }}">
    <input type="text" aria-label="Fechamento" class="form-control field-time" placeholder="Fechamento" name="business_hours[sunday][close]" value="{{ $merchant?->business_hours['sunday']['close'] ?? old('business_hours[sunday][close]') }}">
    </div>
    
    <div class="mb-3">
    <button type="submit" class="btn btn-primary">Salvar</button>
    </div>

    @include('_partials.alerts')
  </div>
  </div>
</div>

@section('page-style')
    <style>
        .input-group-text {
          width: 130px;
        }
    </style>
@endsection

@push('pricing-script')
  <script src="{{ asset('assets/vendor/libs/jquery-mask/jquery.mask.min.js') }}"></script>
  <script>
    jQuery(document).ready(function ($) {
      $('.field-time').mask('00:00');
    });
  </script>
@endpush

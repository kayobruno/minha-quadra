@csrf
<div class="col-md-6">
  <div class="card mb-4">
    <div class="card-body">
      <div class="mb-3">
        <label for="type" class="form-label">Tipo</label>
        <select class="form-select" id="type" name="type">
            @foreach($types as $type)
            <option value="{{ $type }}"
              @if(isset($supplier) && $supplier->type === $type) selected="selected" @endif>
              {{ $type->label() }}
            </option> 
            @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nome" required value="{{ $supplier?->name ?? old('name') }}" autocomplete="given-name" />
      </div>

      <div class="mb-3 cnpj-field" @if(!isset($supplier) || $supplier->type->value === 'cpf') style="display: none;" @endif>
        <label for="trade_name" class="form-label">Nome Fantasia</label>
        <input type="text" class="form-control" id="trade_name" name="trade_name" placeholder="Nome Fantasia" value="{{ $supplier?->trade_name ?? old('trade_name') }}" autocomplete="given-name" />
      </div>

      <div class="mb-3">
        <label for="document" class="form-label">CPF</label>
        <input type="text" class="form-control" id="document" name="document" placeholder="Documento" value="{{ $supplier?->document ?? old('document') }}" />
      </div>

      <div class="mb-3 cnpj-field" @if(!isset($supplier) || $supplier->type->value === 'cpf') style="display: none;" @endif>
        <label for="tax_registration" class="form-label">Inscrição Estadual</label>
        <input type="text" class="form-control" id="tax_registration" name="tax_registration" placeholder="Inscrição Estadual" value="{{ $supplier?->tax_registration ?? old('tax_registration') }}" />
      </div>

      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status">
            @foreach($statuses as $status)
            <option value="{{ $status }}"
              @if(isset($supplier) && $supplier->status === $status) selected="selected" @endif>
              {{ $status->label() }}
            </option> 
            @endforeach
        </select>
      </div>

      <div class="mb-3">
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Voltar</a>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>

      @include('_partials.alerts')
    </div>
  </div>
</div>

@section('page-script')
  <script>
    jQuery(document).ready(function ($) {
      function showFieldsToCPFDocument()
      {
        $("label[for='name']").html('Nome');
        $("label[for='document']").html('CPF');
        $('.cnpj-field').hide();
      }

      function showFieldsToCNPJDocument()
      {
        $("label[for='name']").html('Razão Social');
        $("label[for='document']").html('CNPJ');
        $('.cnpj-field').show();
      }

      $("#type").change(function(){
        let type = $(this).val();
        if (type === 'cpf') {
          showFieldsToCPFDocument();
        } else {
          showFieldsToCNPJDocument();
        }
      });
    });
  </script>
@endsection

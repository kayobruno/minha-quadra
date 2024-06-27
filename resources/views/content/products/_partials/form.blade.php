@csrf
<div class="col-md-6">
  <div class="card mb-4">
    <div class="card-body">
      <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nome" required value="{{ $product?->name ?? old('name') }}" autocomplete="given-name" />
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Descrição</label>
        <textarea class="form-control" id="description" name="description" placeholder="Descrição">{{ $product?->description ?? old('description') }}</textarea>
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">Preço</label>
        <input type="text" class="form-control" id="price" name="price" placeholder="R$ 0,00" value="{{ $product?->price ?? old('price') }}" />
      </div>

      <div class="mb-3">
        <label for="type" class="form-label">Tipo</label>
        <select class="form-select" id="type" name="type">
            @foreach($types as $type)
            <option value="{{ $type }}"
              @if(isset($product) && $product->type === $type) selected="selected" @endif>
              {{ $type->label() }}
            </option> 
            @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="ean" class="form-label">EAN</label>
        <input type="text" class="form-control" id="ean" name="ean" placeholder="Código de Barras" value="{{ $product?->ean ?? old('ean') }}" />
      </div>

      <div class="mb-3">
        <label for="manage_stock" class="form-label">Gerenciar Estoque?</label>
        <input class="form-check-input" type="checkbox" name="manage_stock" value="1" id="manage_stock" @if(isset($product) && $product->manage_stock) checked="" @endif>
      </div>

      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status">
            @foreach($statuses as $status)
            <option value="{{ $status }}"
              @if(isset($product) && $product->status === $status) selected="selected" @endif>
              {{ $status->label() }}
            </option> 
            @endforeach
        </select>
      </div>

      <div class="mb-3">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Voltar</a>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>

      @include('_partials.alerts')
    </div>
  </div>
</div>

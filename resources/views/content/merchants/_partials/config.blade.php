
@csrf

<div class="col-md-6">
  <div class="card mb-4">
  <div class="card-body">
    
    <div class="mb-3">
      <label for="tag_total" class="form-label">Total de Comandas</label>
      <input type="number" class="form-control" id="tag_total" name="configs[tag_total]" placeholder="10" required value="{{ $merchant->getTagTotal() ?? old('tag_total') }}" min="0"/>
    </div>

    <div class="mb-3">
      <label for="min_hours_reserve" class="form-label">Mínimo de Horas para locação</label>
      <input type="number" class="form-control" id="min_hours_reserve" name="configs[min_hours_reserve]" placeholder="1" required value="{{ $merchant->getMinHoursReserve() ?? old('min_hours_reserve') }}" min="1"/>
    </div>
    
    <div class="mb-3">
    <button type="submit" class="btn btn-primary">Salvar</button>
    </div>

    @include('_partials.alerts')
  </div>
  </div>
</div>

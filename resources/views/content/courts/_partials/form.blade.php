@csrf
<div class="col-md-6">
  <div class="card mb-4">
    <div class="card-body">
      <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nome" required value="{{ $court?->name ?? old('name') }}" autocomplete="given-name" />
      </div>

      <div class="mb-3">
        <label for="color" class="form-label">Cor</label>
        <input type="color" class="form-control" id="color" name="color" placeholder="Cor" required value="{{ $court?->color ?? old('color') }}" />
        <div id="floatingInputHelp" class="form-text">Esta cor será exibida no calendário de agendamentos</div>
      </div>

      <div class="mb-3">
        <a href="{{ route('courts.index') }}" class="btn btn-secondary">Voltar</a>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>

      @include('_partials.alerts')
    </div>
  </div>
</div>

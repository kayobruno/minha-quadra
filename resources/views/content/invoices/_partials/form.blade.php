@csrf
<div class="col-md-6">
    <div class="card mb-4">
        <div class="card-body">
            <div class="mb-3">
                <label for="type" class="form-label">Tipo</label>
                <select class="form-select" id="type" name="type">
                    @foreach($types as $type)
                        <option value="{{ $type }}"
                                @if(isset($invoice) && $invoice->type === $type) selected="selected" @endif>
                            {{ $type->label() }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="serie" class="form-label">Série</label>
                <input type="text" class="form-control" id="serie" name="serie" placeholder="Série" required value=""/>
            </div>

            <div class="mb-3">
                <label for="number" class="form-label">Número</label>
                <input type="text" class="form-control" id="number" name="number" placeholder="Número" required value="" />
            </div>

            <div class="mb-3">
                <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>

            @include('_partials.alerts')
        </div>
    </div>
</div>

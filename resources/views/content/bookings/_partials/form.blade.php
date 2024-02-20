@csrf
<div class="col-md-6">
  <div class="card mb-4">
    <div class="card-body">
      <div class="mb-3">

      <div class="mb-3">
        <label for="customer_id" class="form-label">Cliente</label>
        <select class="form-select" id="customer_id" name="customer_id">
            @foreach($customers as $customer)
            <option value="{{ $customer->id }}"
              @if(isset($booking) && $booking->customer_id === $customer->id) selected="selected" @endif>
              {{ $customer->name }}
            </option> 
            @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="court_id" class="form-label">Quadra</label>
        <select class="form-select" id="court_id" name="court_id">
            @foreach($courts as $court)
            <option value="{{ $court->id }}"
              @if(isset($booking) && $booking->court_id === $court->id) selected="selected" @endif>
              {{ $court->name }}
            </option> 
            @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="sport" class="form-label">Modalidade</label>
        <select class="form-select" id="sport" name="sport">
            @foreach($sports as $sport)
            <option value="{{ $sport->value }}"
              @if(isset($booking) && $booking->sport->value === $sport) selected="selected" @endif>
              {{ $sport->label() }}
            </option> 
            @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="when" class="form-label">Quando</label>
        <input type="datetime" class="form-control" id="when" name="when" required value="{{ $booking?->when ?? old('when') }}" />
      </div>

      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status">
            @foreach($statuses as $status)
            <option value="{{ $status->value }}"
              @if(isset($product) && $product->status === $status) selected="selected" @endif>
              {{ $status->label() }}
            </option> 
            @endforeach
        </select>
      </div>

      <div class="mb-3">
        <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Voltar</a>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>

      @include('_partials.alerts')
    </div>
  </div>
</div>

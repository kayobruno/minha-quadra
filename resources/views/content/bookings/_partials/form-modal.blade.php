<div class="offcanvas offcanvas-end event-sidebar" tabindex="-1" id="bookingModal" aria-labelledby="addEventSidebarLabel" data-bs-backdrop="static">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title mb-2" id="addEventSidebarLabel">Agendamento</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body">
    <form class="event-form pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="bookingForm" onsubmit="return false" novalidate="novalidate">
      @csrf
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label" for="customer_name">Nome</label>
          <input type="text" class="form-control flatpickr-input" id="customer_name" name="customer_name" placeholder="Nome">
          <div id="autocomplete-results"></div>
        </div>

        <div class="col-md-6">
          <label class="form-label" for="customer_phone">Telefone</label>
          <input type="text" class="form-control flatpickr-input" id="customer_phone" name="customer_phone" placeholder="(99) 9 9999-9999" >
        </div>

        <input type="hidden" name="customer_id" id="customer_id">
      </div>

      <div class="mb-3">
        <label class="form-label" for="court">Quadra</label>
        <div class="position-relative">
          <select class="select2 select-event-label form-select select2-hidden-accessible" id="court" name="court_id" data-select2-id="court_id" tabindex="-1" aria-hidden="true">
            @foreach ($courts as $court)
            <option value="{{ $court->id }}">{{ $court->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label" for="sport">Modalidade</label>
        <div class="position-relative">
          <select class="select2 select-event-label form-select select2-hidden-accessible" id="sport" name="sport" data-select2-id="sport" tabindex="-1" aria-hidden="true">
            @foreach ($sports as $sport)
              <option value="{{ $sport->value }}">{{ $sport->label() }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="mb-3 fv-plugins-icon-container">
        <label class="form-label" for="date">Data</label>
        <input type="text" class="form-control flatpickr-input" id="date" name="date" placeholder="01/12" readonly>
        <input type="hidden" id="when" name="when">
      </div>

      <div class="mb-3 fv-plugins-icon-container">
        <label class="form-label" for="start_time">Horário Inicial</label>
        <input type="text" class="form-control flatpickr-input" id="start_time" name="start_time" placeholder="00:00" required>
      </div>

      <div class="mb-3 fv-plugins-icon-container">
        <label class="form-label" for="end_time">Horário Final</label>
        <input type="text" class="form-control flatpickr-input" id="end_time" name="end_time" placeholder="00:00" required>
      </div>

      <div class="mb-3">
        <label class="form-label" for="note">Observação:</label>
        <textarea class="form-control" name="note" id="note"></textarea>
      </div>
      
      <div class="mb-3 d-flex justify-content-sm-between justify-content-start my-4">
        <div>
          <button type="submit" class="btn btn-primary btn-add-event me-sm-3 me-1" id="btn-save">Salvar <i class="bx bx-loader bx-spin" id="load" style="display: none;"></i></button>
        </div>
      </div>
    </form>
  </div>
</div>

@section('page-script')
  <script src="{{ asset('assets/vendor/libs/jquery-mask/jquery.mask.min.js') }}"></script>
  <script>
    jQuery(document).ready(function ($) {
      $('#customer_phone').mask('(99) 9 9999-9999');
      $('#start_time').mask('00:00');
      $('#end_time').mask('00:00');
    });
  </script>
@endsection

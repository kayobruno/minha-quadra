@csrf

<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/dist/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datetimepicker/build/jquery.datetimepicker.min.css') }}" />

<div class="col-md-6">
  <div class="card mb-4">
    <div class="card-body">
      <div class="mb-3">

      <div class="mb-3">
        <label for="customer_id" class="form-label">Cliente</label>
        <select class="form-select" id="customer_id" name="customer_id">
          <option></option>
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
        <label for="start_datetime" class="form-label">Data e Horário de Início</label>
        <input type="text" class="form-control" id="start_datetime" name="start_datetime" required value="{{ $booking?->start_datetime ?? old('start_datetime') }}" />
      </div>

      <div class="mb-3">
        <label for="end_datetime" class="form-label">Horário final</label>
        <input type="text" class="form-control" id="end_datetime" name="end_datetime" @if(!isset($booking)) disabled @endif required value="{{ $booking?->end_datetime ?? old('end_datetime') }}" />
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

@section('page-script')
  <script src="{{ asset('assets/vendor/libs/select2/dist/js/select2.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datetimepicker/build/jquery.datetimepicker.full.min.js') }}"></script>

  <script>
    jQuery(document).ready(function ($) {
      $('#customer_id').select2({
        placeholder: "Selecione um cliente",
        allowClear: true,
        minimumInputLength: 3,
        minimumResultsForSearch: 5,
        language: {
          errorLoading: function () {
            return 'Os resultados não puderam ser carregados.';
          },
          inputTooLong: function (args) {
            let overChars = args.input.length - args.maximum;
            let message = 'Por favor, apague ' + overChars + ' caracteres';
            return message;
          },
          inputTooShort: function (args) {
            let remainingChars = args.minimum - args.input.length;
            let message = 'Por favor, digite ' + remainingChars + ' ou mais caracteres';
            return message;
          },
          loadingMore: function () {
            return 'Carregando mais resultados…';
          },
          maximumSelected: function (args) {
            let message = 'Você só pode selecionar ' + args.maximum + ' itens';
            return message;
          },
          noResults: function () {
            return 'Nenhum resultado encontrado';
          },
          searching: function () {
            return 'Buscando…';
          }
        }
      });

      $.datetimepicker.setLocale('pt-BR');
      $('#start_datetime').datetimepicker({
        format: 'd/m/Y H:i',
        minDate: new Date(),
        datepicker: true,
        allowTimes:[
          '12:00', '13:00', '15:00',
          '17:00', '17:05', '17:20', '19:00', '20:00'
        ],
        weekends:['01.02.2024','02.02.2024','03.02.2024','04.02.2024','05.02.2024','06.02.2024'],
      });

      $('#start_datetime').change(function(event) {
        let startDatetime = $(this).val();
        if (startDatetime) {
          let minEndtime = addOneHourToDateString(startDatetime).substring(11);
          $('#end_datetime').removeAttr('disabled');
          $('#end_datetime').datetimepicker({
            minTime: minEndtime,
            format: 'H:i',
            datepicker: false,
            allowTimes:[
              '12:00', '13:00', '15:00',
              '17:00', '17:05', '17:20', '19:00', '20:00'
            ]
          });
        }
      });

      function addOneHourToDateString(dateString) {
        const [day, month, year, hours, minutes] = dateString.split(/[\s/:\s]/);
        const date = new Date(year, month - 1, day, hours, minutes);

        date.setHours(date.getHours() + 1);
        const formattedDate = `${padZero(date.getDate())}/${padZero(date.getMonth() + 1)}/${date.getFullYear()} ${padZero(date.getHours())}:${padZero(date.getMinutes())}`;

        return formattedDate;
      }

      function padZero(num) {
        return num < 10 ? `0${num}` : num;
      }
    });
  </script>
@endsection

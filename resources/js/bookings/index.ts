import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import momentPlugin from '@fullcalendar/moment'
import timegridPlugin from '@fullcalendar/timegrid'
import listPlugin from '@fullcalendar/list'
import interactionPlugin from '@fullcalendar/interaction'
import dayjs from 'dayjs'
import { BookingData } from './bookingData'
import { BookingService } from './bookingService.ts'
import { BookingParams } from './bookingParams.ts'
import { Offcanvas } from 'bootstrap'
import { Response } from '../response/response.ts'
import { CustomerSerive } from '../customers/customerService.ts'

async function initCalendar(): Promise<void> {
  const calendarEl = document.getElementById('calendar');
  const calendar = new Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    plugins: [momentPlugin, dayGridPlugin, listPlugin, timegridPlugin, interactionPlugin],
    locale: 'pt-br',
    buttonText: { today: 'Hoje' },
    events: [],
    dayMaxEvents: 8,
    eventClick: async function (info) {
      const booking = await BookingService.getBooking(info.event.id);
      const bookingDate = dayjs(booking.start);
      const currentDate = dayjs();

      if (bookingDate.isBefore(currentDate, 'day')) {
        disableOrEnableForm(true);
      }

      showBooking(booking);
    },
    eventContent: function(info) {
      const start = dayjs(info.event.start);
      const end = dayjs(info.event.end);

      const timeFormatted = `<b>${start.hour()}:${start.minute().toString().padStart(2, '0')}</b> até <b>${end.hour()}:${end.minute().toString().padStart(2, '0')}</b>`;
      const icon = info.event.extendedProps.sport.icon;

      let html = `
        <div style="border-color: ${info.event.extendedProps.court.color_hex};">${icon}</div>
        <div class="fc-event-time">${timeFormatted}</div>
      `;

      return {
        html: html
      };
    },
    eventDidMount: function(info) {
      let link = info.el;
      link.style.background = info.event.extendedProps.court.color_rgba;
      link.style.cursor = 'pointer';
      link.setAttribute('data-bs-target', '#bookingModal');
      link.setAttribute('data-bs-toggle', 'offcanvas');
    },
    datesSet: async function(info) {
      const bookings = await BookingService.getBookings(info.startStr, info.endStr);

      calendar.getEvents().forEach(event => event.remove());
      calendar.addEventSource(bookings);
    },
    dateClick: function(info) {
      const dateClicked = dayjs(info.date);
      const currentDate = dayjs();

      if (dateClicked.isBefore(currentDate, 'day')) {
        return;
      }

      const bookingData: BookingData = {
        when: dayjs(info.date),
        start: dayjs().format('HH:mm'),
        end: dayjs().add(1, 'hour').format('HH:mm'),
        note: '',
        customerName: '',
        customerPhone: '',
      };

      setValuesToBookingForm(bookingData);

      const bookingModalElement = document.getElementById('bookingModal');
      const bookingModal = new Offcanvas(bookingModalElement);

      bookingModal.show();
    }
  });

  calendar.render();  

  const form = document.getElementById('bookingForm') as HTMLFormElement;

  form.addEventListener('submit', async function(event) {
    event.preventDefault();

    const load = document.getElementById('load');
    const btnSave = document.getElementById('btn-save');
    const successMessage = document.getElementById('success-message');

    successMessage.style.display = 'none';
    load.style.display = 'block';
    btnSave.disabled = true;

    removeErrors();
    
    const formData = new FormData(form);
    const bookingParams: BookingParams = {
      customer_name: '',
      customer_document: '',
      when: '',
      start_time: '',
      end_time: '',
      court_id: 1,
      sport: '',
      status: ''
    };

    formData.forEach(function(value, key) {
      bookingParams[key] = value;
    });

    try {
      const response = await BookingService.saveBooking(bookingParams);
      if (response.success == false) {
        showErrors(response);
        return;
      }

      const oldBooking = calendar.getEventById(response.data.id);
      if (oldBooking) {
        oldBooking.remove();
      }

      calendar.addEvent(response.data);
      successMessage.style.display = 'block';

      const bookingId = document.getElementById('booking_id') as HTMLInputElement;
      bookingId.value = response.data.id;
    } finally {
      load.style.display = 'none';
      btnSave.disabled = false;
    }
  });
}

function showBooking(booking: {}): void {
  const bookingData: BookingData = {
    id: booking.id,
    when: dayjs(booking.start),
    start: dayjs(booking.start).format('HH:mm'),
    end: dayjs(booking.end).format('HH:mm'),
    customerName: booking.customer.name,
    customerPhone: booking.customer.phone,
    courtId: booking.court.id,
    sport: booking.sport.value,
    note: booking.note
  };

  setValuesToBookingForm(bookingData);
}

function setValuesToBookingForm(bookingData: BookingData): void {
  const startInput = document.getElementById('start_time') as HTMLInputElement;
  const endInput = document.getElementById('end_time') as HTMLInputElement;
  const courtSelect = document.getElementById('court') as HTMLSelectElement;
  const sportSelect = document.getElementById('sport') as HTMLSelectElement;
  const note = document.getElementById('note') as HTMLTextAreaElement;
  const when = document.getElementById('when') as HTMLInputElement;
  const date = document.getElementById('date') as HTMLInputElement;
  const customerName = document.getElementById('customer_name') as HTMLInputElement;
  const customerPhone = document.getElementById('customer_phone') as HTMLInputElement;
  const bookingId = document.getElementById('booking_id') as HTMLInputElement;

  if (bookingData.id !== null && bookingData.id !== undefined) {
    bookingId.value = bookingData.id;
  }

  startInput.value = bookingData.start;
  endInput.value = bookingData.end;
  courtSelect.value = bookingData.courtId;
  sportSelect.value = bookingData.sport;
  note.value = bookingData.note;
  when.value = bookingData.when.format('YYYY-MM-DD');
  date.value = bookingData.when.format('DD/MM');
  customerName.value = bookingData.customerName;
  customerPhone.value = bookingData.customerPhone;
}

function showErrors(response: Response): void {
  for (const fieldName in response.data) {
    const errorMessage = response.data[fieldName][0];
    const inputElement = document.querySelector(`[name="${fieldName}"]`);
    
    if (inputElement) {
      inputElement.classList.add('is-invalid');
      const errorElement = document.createElement('div');
      errorElement.textContent = errorMessage;
      errorElement.classList.add('invalid-feedback');
      
      const existingErrorMessage = inputElement.parentNode.querySelector('.error-message');
      if (existingErrorMessage) {
        existingErrorMessage.remove();
      }
      
      inputElement.parentNode.appendChild(errorElement);
    }
  }
}

function removeErrors(): void {
  const errorMessages = document.querySelectorAll('.invalid-feedback');
  errorMessages.forEach(element => element.remove());

  const errorInputs = document.querySelectorAll('.is-invalid');
  errorInputs.forEach(input => input.classList.remove('is-invalid'));
}

function disableOrEnableForm(status: boolean): void {
  const btnSave = document.getElementById('btn-save') as HTMLFormElement;
  const form = document.getElementById('bookingForm') as HTMLFormElement;
  if (form) {
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => input.disabled = status);
  }
  btnSave.disabled = status;
}

const modalOffcanvas = document.getElementById('bookingModal');
modalOffcanvas?.addEventListener('hidden.bs.offcanvas', () => {
  removeErrors();
  disableOrEnableForm(false);
  
  const successMessage = document.getElementById('success-message');
  successMessage.style.display = 'none';

  const bookingId = document.getElementById('booking_id') as HTMLInputElement;
  bookingId.value = '';
});

document.addEventListener('DOMContentLoaded', initCalendar);

let timeoutId: NodeJS.Timeout;
async function updateAutocompleteResultsDebounced(query: string): Promise<void> {
  clearTimeout(timeoutId);

  timeoutId = setTimeout(async () => {
      await updateAutocompleteResults(query);
  }, 300);
}

async function updateAutocompleteResults(query: string): Promise<void> {
  const resultsContainer = document.getElementById('autocomplete-results');

  resultsContainer.innerHTML = '';

  if (query.length >= 3) {
    const suggestions = await CustomerSerive.getCustomerByName(query);

    suggestions.forEach(suggestion => {
      const suggestionElement = document.createElement('div');
      suggestionElement.textContent = suggestion.name + (suggestion.phone ? ' - ' + suggestion.phone : '');
      suggestionElement.classList.add('suggestion');
      resultsContainer.appendChild(suggestionElement);

      suggestionElement.addEventListener('click', () => {
        inputField.value = suggestion.name;

        document.getElementById('customer_phone').value = suggestion.phone;
        document.getElementById('customer_id').value = suggestion.id.toString();

        resultsContainer.innerHTML = '';
      });
    });
  }
}

const inputField = document.getElementById('customer_name') as HTMLInputElement;
inputField.addEventListener('input', (event) => {
    const query = inputField.value;
    updateAutocompleteResultsDebounced(query);
});

import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import momentPlugin from '@fullcalendar/moment'
import timegridPlugin from '@fullcalendar/timegrid'
import listPlugin from '@fullcalendar/list'
import axios from 'axios'

async function getBookings(start: string | null, end: string | null): Promise<any[]> {
  try {
    const response = await axios.get('/api/bookings', {
      params: { start, end }
    });

    return response.data.data;
  } catch (error) {
    console.error('Erro ao buscar agendamentos:', error);
    throw error;
  }
}

async function initCalendar() {
  const calendarEl = document.getElementById('calendar');

  const calendar = new Calendar(calendarEl, {
    timeZone: 'America/Fortaleza',
    initialView: 'dayGridMonth',
    plugins: [momentPlugin, dayGridPlugin, listPlugin, timegridPlugin],
    locale: 'pt-br',
    buttonText: { today: 'Hoje' },
    events: [],
    eventClick: info => console.log(info.event.id),
    eventContent: function(arg) {
      const startTime = arg.event.start.toLocaleTimeString('pt-BR', {hour: '2-digit', minute: '2-digit'});
      const endTime = arg.event.end.toLocaleTimeString('pt-BR', {hour: '2-digit', minute: '2-digit'});
      const timeFormatted = `<b>${startTime}</b> até <b>${endTime}</b>`;
      const icon = arg.event.extendedProps.sport.icon;

      let html = `
        <div class="" style="border-color: ${arg.event.extendedProps.court.color_hex};">${icon}</div>
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
    },
    dateClick: function(info) {
      console.log(info);
    },
    datesSet: async function(info) {
      let events = await getBookings(info.startStr, info.endStr);

      calendar.getEvents().forEach(function(event) {
        event.remove();
      });

      calendar.addEventSource(events);
    }
  });

  calendar.render();  
}

document.addEventListener('DOMContentLoaded', initCalendar);

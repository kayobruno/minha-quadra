import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import momentPlugin from '@fullcalendar/moment'
import timegridPlugin from '@fullcalendar/timegrid'
import listPlugin from '@fullcalendar/list'
import interactionPlugin from '@fullcalendar/interaction'

document.addEventListener('DOMContentLoaded', function() {
  let calendarEl = document.getElementById('calendar');
  let events = [
    {
      id: '1',
      title: 'Quadra 01',
      start: '2024-02-27T10:00:00Z',
      end: '2024-02-27T12:00:00Z',
      color: 'rgba(231, 76, 64, 0.5)',
      textColor: 'white',
      icon: 'bx-football'
    },
    {
      id: '20',
      title: 'Quadra 02',
      start: '2024-02-28T14:00:00Z',
      end: '2024-02-28T15:00:00Z',
      color: 'rgba(62, 209, 129, 0.5)',
      textColor: 'white',
      icon: 'bx-basketball'
    },
    {
      id: '30',
      title: 'Quadra 02',
      start: '2024-03-17 08:00:00',
      end: '2024-03-17 10:00:00',
      color: 'rgba(79, 149, 218, 0.5)',
      textColor: 'white',
      icon: 'bx-tennis-ball'
    },
  ];

  let calendar = new Calendar(calendarEl, {
    timeZone: 'America/Fortaleza',
    initialView: 'dayGridMonth',
    plugins: [momentPlugin, dayGridPlugin, interactionPlugin, listPlugin, timegridPlugin],
    locale: 'pt-br',
    slotDuration: '24:00:00',
    buttonText: {
      today: 'Hoje'
    },
    events: events,
    eventClick: function(info) {
      console.log(info.event.id);
    },
    eventContent: function(arg) {
      const startTime = arg.event.start.toLocaleTimeString('pt-BR', {hour: '2-digit', minute: '2-digit'});
      const endTime = arg.event.end.toLocaleTimeString('pt-BR', {hour: '2-digit', minute: '2-digit'});
      const timeFormatted = `<b>${startTime}</b> até <b>${endTime}</b>`;
      const icon = arg.event.extendedProps.icon;

      let html = `
        <div class="" style="border-color: ${arg.backgroundColor};"><i class="bx-tada-hover bx ${icon} fc-daygrid-event-icon" title="Vôlei"></i></div>
        <div class="fc-event-time">${timeFormatted}</div>
      `;

      return {
        html: html
      };
    },
    eventDidMount: function(info) {
      let link = info.el;
      link.style.background = info.backgroundColor;
      link.style.cursor = 'pointer';
    },
  });

  calendar.render();
});

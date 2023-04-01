$(document).ready(function () {
  $("#calendar").fullCalendar({
    themeSystem: "bootstrap",
    header: {
      left: "prev,next today",
      center: "title",
      right: "month,basicWeek,basicDay",
    },
    events: [
      // Aquí puedes agregar los eventos a mostrar en el calendario
    ],
  });
});

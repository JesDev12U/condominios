let tblReservaciones = new DataTable("#tblReservaciones", {
  language: {
    decimal: "",
    emptyTable: "No hay información",
    info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
    infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
    infoFiltered: "(Filtrado de _MAX_ total entradas)",
    infoPostFix: "",
    thousands: ",",
    lengthMenu: "Mostrar _MENU_ Entradas",
    loadingRecords: "Cargando...",
    processing: "Procesando...",
    search: "Buscar:",
    zeroRecords: "Sin resultados encontrados",
    paginate: {
      first: "Primero",
      last: "Ultimo",
      next: "Siguiente",
      previous: "Anterior",
    },
  },
  responsive: true,
  dom: "Bfrtip",
  buttons: [
    {
      extend: "copyHtml5",
      text: '<i class="fa-solid fa-copy"></i>',
      exportOptions: {
        columns: [1, 2, 3, 4, 5, 6, 7, 8],
      },
      titleAttr: "Copiar",
      className: "btn btn-primary",
    },
    {
      extend: "excelHtml5",
      text: '<i class="fa-solid fa-file-excel"></i>',
      exportOptions: {
        columns: [1, 2, 3, 4, 5, 6, 7, 8],
      },
      titleAttr: "Excel",
      className: "btn btn-success",
    },
    {
      extend: "csvHtml5",
      text: '<i class="fa-solid fa-file-csv"></i>',
      exportOptions: {
        columns: [1, 2, 3, 4, 5, 6, 7, 8],
      },
      titleAttr: "CSV",
      className: "btn btn-info",
    },
    {
      extend: "pdfHtml5",
      text: '<i class="fas fa-file-pdf"></i>',
      exportOptions: {
        columns: [1, 2, 3, 4, 5, 6, 7, 8],
      },
      titleAttr: "PDF",
      className: "btn btn-danger",
    },
  ],
});

<div class="container">
  <a href="<?php echo SITE_URL . RUTA_CONDOMINO ?>reservar-eventos" class="btn btn-primary">
    <i class="fa-solid fa-arrow-left"></i>
  </a>
  <div class="formSection" class="mt-5">
    <div class="row">
      <!-- Lineamientos -->
      <div class="col">
        <h5 class="text-center mb-4">Lineamientos de uso para el salón de eventos</h5>
        <div class="container-fluid">
          <p>
            El horario para el uso del salón de eventos, son de 9:00 a 14:00hrs y/o de 17:00 a 22:00 hrs.

            El propietario es el encargado de poner y quitar la decoración de acuerdo con el evento que tenga programado.
            El aforo máximo al salón de eventos es de 50 personas.

            La renta del salón incluye 5 mesas para 10 personas y 50 sillas plegables, tarja, conexiones a electricidad, baño para hombres, baño para mujeres, lavabo.

            Se cobra por concepto de RENTA DE SALON, la cantidad de $2,500.00 (Dos mil quinientos pesos 00/100 M.N), de los cuales $1,000.00 son deposito por alguna avería a las instalaciones, los cuales se reembolsan al propietario una vez verificado que no haya averías en las instalaciones.

            El propietario es el responsable de entregar el salón con las mesas y sillas limpias y cerradas.

            El propietario debe dejar libre de basura y/o decoración en el salón de eventos; en caso, de NO regresar en las condiciones de limpieza, no se reembolsa la cantidad de depósito, ya que se tendría que pagar por el servicio de limpieza y acomodo de las mesas y sillas.

            Los invitados al evento NO pueden utilizar las áreas como ludoteca y gimnasio o andar paseando dentro de las instalaciones del condominio.

            No hay acceso a estacionamiento a autos que no sean condóminos.
          </p>
        </div>
      </div>
      <!-- Formulario -->
      <div class="col">
        <h5 class="text-center mb-4">Registro</h5>
        <form id="form-datos">
          <input type="hidden" name="peticion" value="<?php echo $this->peticion ?>">
          <?php
          if (!is_null($this->id_evento)) {
            echo '<input type="hidden" name="id_evento" value="' . $this->id_evento . '" />';
          }
          ?>
          <div class="mb-3">
            <label for="cantidad_personas" class="form-label"><i class="fa-solid fa-users"></i>&nbsp;Cantidad de personas</label>
            <input
              type="number"
              class="form-control"
              id="cantidad_personas"
              name="cantidad_personas"
              value="<?php echo is_null($this->id_evento) ? "" : $this->cantidad_personas ?>"
              placeholder="Ingresa aquí la cantidad de personas"
              required />
          </div>
          <div class="mb-3">
            <label for="fecha" class="form-label"><i class="fa-solid fa-calendar-days"></i>&nbsp;Fecha</label>
            <input
              type="date"
              class="form-control timePicker"
              id="fecha"
              name="fecha"
              value="<?php echo is_null($this->id_evento) ? "" : $this->fecha ?>"
              placeholder="Ingresa aquí la fecha"
              required />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
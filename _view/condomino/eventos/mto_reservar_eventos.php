<div class="container">
  <a href="<?php echo SITE_URL . RUTA_CONDOMINO ?>reservar-eventos" class="btn btn-primary">
    <i class="fa-solid fa-arrow-left"></i>
  </a>
  <div class="formSection" class="mt-5">
    <div class="row">
      <!-- Lineamientos -->
      <div class="col" id="lineamientos-container">
        <h5 class="text-center mb-4">Lineamientos de uso para el salón de eventos</h5>
        <div class="container-fluid">
          <p>
            El horario para el uso del salón de eventos, son de 9:00 a 14:00hrs y/o de 17:00 a 22:00 hrs.
          </p>
          <p>
            El propietario es el encargado de poner y quitar la decoración de acuerdo con el evento que tenga programado.
          </p>
          <p>
            El aforo máximo al salón de eventos es de 50 personas.
          </p>
          <p>
            La renta del salón incluye 5 mesas para 10 personas y 50 sillas plegables, tarja, conexiones a electricidad, baño para hombres, baño para mujeres, lavabo.
          </p>
          <p>
            Se cobra por concepto de RENTA DE SALON, la cantidad de $2,500.00 (Dos mil quinientos pesos 00/100 M.N), de los cuales $1,000.00 son deposito por alguna avería a las instalaciones, los cuales se reembolsan al propietario una vez verificado que no haya averías en las instalaciones.
          </p>
          El propietario es el responsable de entregar el salón con las mesas y sillas limpias y cerradas.
          <p>
            El propietario debe dejar libre de basura y/o decoración en el salón de eventos; en caso, de NO regresar en las condiciones de limpieza, no se reembolsa la cantidad de depósito, ya que se tendría que pagar por el servicio de limpieza y acomodo de las mesas y sillas.
          </p>
          Los invitados al evento NO pueden utilizar las áreas como ludoteca y gimnasio o andar paseando dentro de las instalaciones del condominio.
          <p>
            No hay acceso a estacionamiento a autos que no sean condóminos.
          </p>
        </div>
      </div>
      <!-- Formulario -->
      <div class="col">
        <h5 class="text-center mb-4">Registro</h5>
        <form id="form-datos">
          <div class="general-container-foto" style="margin-bottom: 50px;">
            <label for="foto_path" class="form-label"><i class="fa-solid fa-image"></i>&nbsp;Foto</label>
            <div class="wrapper-foto">
              <div class="container-foto">
                <?php
                if (!is_null($this->id_evento)) {
                  echo "<img id='foto-evento' src='$this->foto_path' alt='$this->foto_path' style='max-width: 250px; max-height: 250px;'>";
                } else {
                  $placeholderImagePath = SITE_URL . "uploads/placeholderimage.jpg";
                  echo "<img id='foto-evento' src='$placeholderImagePath' alt='$placeholderImagePath' style='max-width: 250px; max-height: 250px;'>";
                }
                ?>
              </div>
            </div>
            <input type="file" id="foto-file" accept="image/*" name="foto_path" />
          </div>
          <input type="hidden" name="peticion" value="<?php echo $this->peticion ?>">
          <input type="hidden" name="id_condomino" value="<?php echo $this->id_condomino ?>">
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
          <div class="mb-3">
            <label for="turno" class="form-label"><i class="fa-solid fa-clock"></i>&nbsp;Turno</label>
            <select name="turno" id="turno" class="form-control">
              <option value="Matutino"
                <?php
                if (!is_null($this->id_evento) && $this->turno === "Matutino")
                  echo "selected";
                ?>>Matutino -> 9:00 a 14:00hrs</option>
              <option value="Vespertino"
                <?php
                if (!is_null($this->id_evento) && $this->turno === "Vespertino")
                  echo "selected";
                ?>>Vespertino -> 17:00 a 22:00 hrs</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="detalles_evento" class="form-label"><i class="fa-solid fa-star"></i>&nbsp;Detalles del evento</label>
            <textarea name="detalles_evento" id="detalles_evento" class="form-control" placeholder="Ingresa aquí los detalles del evento"><?php echo is_null($this->id_evento) ? "" : $this->detalles_evento ?></textarea>
          </div>
          <div class="mb-3">
            <label for="tipo_evento" class="form-label"><i class="fa-solid fa-wand-magic-sparkles"></i>&nbsp;Tipo de evento</label>
            <input
              type="text"
              class="form-control"
              id="tipo_evento"
              name="tipo_evento"
              value="<?php echo is_null($this->id_evento) ? "" : $this->tipo_evento ?>"
              placeholder="Bautizo, Boda, Cumpleaños ..."
              required />
          </div>
          <div class="container" style="margin-bottom: 50px;">
            <button type="submit" class="btn btn-success" id="btn-send">
              <i class="fa-solid fa-check"></i>
              Enviar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  const $fotoEvento = document.getElementById("foto-evento");
  const $formDatos = document.getElementById("form-datos");
  const $fotoFile = document.getElementById("foto-file");

  $fotoFile.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (file) {
      const urlTemporal = URL.createObjectURL(file);
      $fotoEvento.src = urlTemporal;

      //Limpieza de la URL temporal cuando ya no se necesite
      $fotoFile.onload = () => URL.revokeObjectURL(urlTemporal);
    }
  });

  $formDatos.addEventListener("submit", function(e) {
    e.preventDefault();
    if ($fotoEvento.src === "<?php echo SITE_URL ?>uploads/placeholderimage.jpg") {
      Swal.fire({
        icon: "error",
        title: "¡Error!",
        text: "Tienes que subir una foto para el evento"
      });
      return;
    }
    const formData = new FormData(this);

    asyncConfirmProcess(
      formData,
      `<?php echo SITE_URL; ?>_controller/condomino/eventos/AsyncMtoReservarEventos.php`,
      "Confirmación",
      "¿Está seguro de agendar el evento?",
      "¡Evento agendado correctamente!"
    );
  });
</script>
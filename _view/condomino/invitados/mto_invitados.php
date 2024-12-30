<?php

use chillerlan\QRCode\{QRCode, QROptions};
?>
<div class="container">
  <a href="<?php echo SITE_URL . RUTA_CONDOMINO ?>invitados" class="btn btn-primary">
    <i class="fa-solid fa-arrow-left"></i>
  </a>
  <div id="formSection" class="mt-5">
    <!-- Formulario -->
    <form id="form-datos">
      <input type="hidden" name="peticion" value="<?php echo $this->peticion ?>">
      <?php
      if (!is_null($this->id_invitado)) {
        echo '<input type="hidden" name="id_invitado" value="' . $this->id_invitado . '" />';
      }
      ?>
      <div class="mb-3">
        <label for="nombre" class="form-label"><i class="fa-solid fa-user"></i>&nbsp;Nombre</label>
        <input
          type="text"
          class="form-control"
          id="nombre"
          name="nombre"
          value="<?php echo is_null($this->id_invitado) ? "" : $this->nombre ?>"
          placeholder="Ingresa aquí el nombre del invitado"
          required />
      </div>
      <div class="mb-3">
        <label for="curp" class="form-label"><i class="fa-solid fa-id-card"></i>&nbsp;CURP</label>
        <input
          type="text"
          class="form-control"
          id="curp"
          name="curp"
          value="<?php echo is_null($this->id_invitado) ? "" : $this->curp ?>"
          placeholder="Ingresa aquí el CURP del invitado"
          required />
      </div>
      <div class="mb-3">
        <label for="horario_inicio" class="form-label"><i class="fa-solid fa-clock"></i>&nbsp;Horario de inicio</label>
        <input
          type="time"
          class="form-control timePicker"
          id="horario_inicio"
          name="horario_inicio"
          value="<?php echo is_null($this->id_invitado) ? "" : $this->horario_inicio ?>"
          placeholder="Ingresa aquí el horario de inicio del invitado"
          required />
      </div>
      <div class="mb-3">
        <label for="horario_final" class="form-label"><i class="fa-solid fa-clock"></i>&nbsp;Horario final</label>
        <input
          type="time"
          class="form-control timePicker"
          id="horario_final"
          name="horario_final"
          value="<?php echo is_null($this->id_invitado) ? "" : $this->horario_final ?>"
          placeholder="Ingresa aquí el horario final del invitado"
          required />
      </div>
      <div class="mb-3">
        <label for="asunto" class="form-label"><i class="fa-solid fa-tag"></i>&nbsp;Asunto</label>
        <select name="asunto" id="asunto" class="form-control">
          <option value="Visita"
            <?php
            if (!is_null($this->id_invitado) && $this->asunto === "Visita")
              echo "selected";
            ?>>Visita</option>
          <option value="Evento"
            <?php
            if (!is_null($this->id_invitado) && $this->asunto === "Evento")
              echo "selected";
            ?>>Evento</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="integrantes" class="form-label"><i class="fa-solid fa-users"></i>&nbsp;Integrantes</label>
        <input
          type="number"
          class="form-control"
          id="integrantes"
          name="integrantes"
          value="<?php echo is_null($this->id_invitado) ? "" : $this->integrantes ?>"
          placeholder="Ingresa aquí el número de integrantes a invitar"
          required />
      </div>
    </form>

    <div class="container" style="margin-bottom: 50px;">
      <button type="submit" class="btn btn-success" id="btn-send">
        <i class="fa-solid fa-check"></i>
        Enviar
      </button>
    </div>

  </div>
</div>
<script>
  const $btnSend = document.getElementById("btn-send");

  $btnSend.addEventListener("click", (e) => {
    e.preventDefault();
    const formDataDatos = new FormData(document.getElementById("form-datos"));

    asyncConfirmProcess(
      formDataDatos,
      `<?php echo SITE_URL; ?>_controller/condomino/invitados/AsyncMtoInvitados.php`,
      "Confirmación",
      "¿Está seguro de registrar los datos del invitado?",
      "¡Datos modificados correctamente!",
    )

  });
</script>
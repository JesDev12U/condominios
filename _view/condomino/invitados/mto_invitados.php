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
      <input type="hidden" name="id_condomino" value="<?php echo $this->id_condomino ?>">
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
        <span id="error-nombre" class="span-errors hidden">El nombre no puede ser vacío</span>
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
        <span id="error-curp" class="span-errors hidden">CURP inválido</span>
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
        <span id="error-horario-inicio" class="span-errors hidden">Hora inválida</span>
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
        <span id="error-horario-final" class="span-errors hidden">Hora inválida</span>
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
          min="1"
          max="50"
          id="integrantes"
          name="integrantes"
          value="<?php echo is_null($this->id_invitado) ? "" : $this->integrantes ?>"
          placeholder="Ingresa aquí el número de integrantes a invitar"
          required />
        <span id="error-integrantes" class="span-errors hidden">Cantidad inválida</span>
      </div>
    </form>

    <div class="container" style="margin-bottom: 50px;">
      <button type="submit" class="btn btn-success" id="btn-send" data-url="<?php echo SITE_URL ?>">
        <i class="fa-solid fa-check"></i>
        Enviar
      </button>
    </div>

  </div>
</div>
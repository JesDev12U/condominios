<div class="loader-container hidden" id="loader-ine">
  <l-ring
    size="40"
    stroke="5"
    bg-opacity="0"
    speed="2"
    color="blue"></l-ring>
  <h3>Leyendo INE</h3>
</div>
<div class="container">
  <h1>Registro</h1>
  <!-- Formulario para subir la imagen -->
  <div id="uploadZone" class="drop-zone mt-5">
    <h5>Sube tu INE</h5>
    <p>Arrastra o selecciona un archivo</p>
    <input
      type="file"
      id="fileInput"
      name="image"
      class="form-control d-none"
      required />
  </div>
  <div id="formSection" class="hidden mt-5">
    <div class="row">
      <!-- Formulario que aparece tras subir el archivo -->
      <div class="col">
        <h5 class="text-center mb-4">Información Personal</h5>
        <form id="form-datos">
          <div class="mb-3">
            <label for="nombre" class="form-label"><i class="fa-solid fa-user"></i>&nbsp;Nombre</label>
            <input
              type="text"
              class="form-control"
              id="nombre"
              placeholder="Ingresa aquí el nombre del empleado"
              required />
          </div>
          <div class="mb-3">
            <label for="email" class="form-label"><i class="fa-solid fa-envelope"></i>&nbsp;Correo electrónico</label>
            <input
              type="email"
              class="form-control"
              id="email"
              placeholder="Ingresa aquí el correo electrónico del empleado"
              required />
          </div>
          <div class="mb-3">
            <label for="password" class="form-label"><i class="fa-solid fa-lock"></i>&nbsp;Contraseña</label>
            <div class="input-group">
              <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa aquí una contraseña para el empleado" required>
              <button class="btn btn-outline-secondary" id="toggle-password" type="button">
                <i class="fa-solid fa-eye"></i>
              </button>
            </div>
          </div>
          <div class="mb-3">
            <label for="telefono" class="form-label"><i class="fa-solid fa-phone"></i>&nbsp;Teléfono</label>
            <input
              type="text"
              class="form-control"
              id="telefono"
              placeholder="Ingresa aquí el teléfono del empleado"
              required />
          </div>
          <div class="mb-3">
            <label for="telefono_emergencia" class="form-label"><i class="fa-solid fa-tower-broadcast"></i>&nbsp;Teléfono de emergencia</label>
            <input
              type="text"
              class="form-control"
              id="telefono_emergencia"
              placeholder="Ingresa aquí el teléfono de emergencia del empleado"
              required />
          </div>
        </form>
      </div>
      <div class="col general-container-foto" style="margin-bottom: 50px;">
        <h5 class="text-center mb-4">Foto</h5>
        <div class="wrapper-foto">
          <div class="container-foto">
            <?php
            if (file_exists($this->foto_path)) {
              echo "<img id='foto-user' src='$this->foto_path' alt='$this->foto_path' style='max-width: 150px; max-height: 150px;'>
                        <p>Foto de $this->nombre</p>";
            } else {
              $placeholderUserPath = SITE_URL . "uploads/placeholderuser.png";
              echo "<img id='foto-user' src='$placeholderUserPath' alt='$placeholderUserPath' style='max-width: 250px; max-height: 250px;'>";
            }
            ?>
          </div>
        </div>
        <input type="file" id="foto-file">
      </div>
      <div class="container" style="margin-bottom: 50px;">
        <button class="btn btn-warning" id="btn-reload-ine">
          <i class="fa-solid fa-address-card"></i>
          Volver a subir INE
        </button>
        <button type="submit" class="btn btn-success" id="btn-send">
          <i class="fa-solid fa-check"></i>
          Enviar
        </button>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo SITE_URL ?>js/cargaINE.js"></script>
<script src="<?php echo SITE_URL ?>js/ajaxGestoresUsuarios.js"></script>
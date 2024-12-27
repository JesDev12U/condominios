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
  <a href="<?php echo SITE_URL . RUTA_ADMINISTRADOR ?>gestor-empleados" class="btn btn-primary">
    <i class="fa-solid fa-arrow-left"></i>
    Regresar al gestor de empleados
  </a>
  <h1>Registro</h1>
  <!-- Formulario para subir la imagen -->
  <div id="uploadZone" class="drop-zone mt-5 <?php echo is_null($this->id_empleado) ? "" : "hidden" ?>">
    <h5>Sube tu INE</h5>
    <p>Arrastra o selecciona un archivo</p>
    <input
      type="file"
      id="fileInput"
      name="image"
      class="form-control d-none"
      required />
  </div>
  <div id="formSection" class="<?php echo is_null($this->id_empleado) ? "hidden" : "" ?> mt-5">
    <div class="row">
      <!-- Formulario que aparece tras subir el archivo -->
      <div class="col">
        <h5 class="text-center mb-4">Información Personal</h5>
        <form id="form-datos">
          <input type="hidden" name="peticion" value="<?php echo $this->peticion ?>">
          <?php if (!is_null($this->id_empleado)) echo '<input type="hidden" name="id_empleado" value="' . $this->id_empleado . '" />' ?>
          <div class="mb-3">
            <label for="nombre" class="form-label"><i class="fa-solid fa-user"></i>&nbsp;Nombre</label>
            <input
              type="text"
              class="form-control"
              id="nombre"
              name="nombre"
              value="<?php echo is_null($this->id_empleado) ? "" : $this->nombre ?>"
              placeholder="Ingresa aquí el nombre del empleado"
              required />
          </div>
          <div class="mb-3">
            <label for="email" class="form-label"><i class="fa-solid fa-envelope"></i>&nbsp;Correo electrónico</label>
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              value="<?php echo is_null($this->id_empleado) ? "" : $this->email ?>"
              placeholder="Ingresa aquí el correo electrónico del empleado"
              required />
          </div>
          <div class="mb-3">
            <label for="password" class="form-label"><i class="fa-solid fa-lock"></i>&nbsp;Contraseña</label>
            <div class="input-group">
              <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa aquí una contraseña para el empleado" <?php echo is_null($this->id_empleado) ? "" : "disabled" ?> />
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
              name="telefono"
              value="<?php echo is_null($this->id_empleado) ? "" : $this->telefono ?>"
              placeholder="Ingresa aquí el teléfono del empleado"
              required />
          </div>
          <div class="mb-3">
            <label for="telefono_emergencia" class="form-label"><i class="fa-solid fa-tower-broadcast"></i>&nbsp;Teléfono de emergencia</label>
            <input
              type="text"
              class="form-control"
              id="telefono_emergencia"
              name="telefono_emergencia"
              value="<?php echo is_null($this->id_empleado) ? "" : $this->telefono_emergencia ?>"
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
            if (!is_null($this->id_empleado)) {
              echo "<img id='foto-user' src='$this->foto_path' alt='$this->foto_path' style='max-width: 250px; max-height: 250px;'>";
            } else {
              $placeholderUserPath = SITE_URL . "uploads/placeholderuser.png";
              echo "<img id='foto-user' src='$placeholderUserPath' alt='$placeholderUserPath' style='max-width: 250px; max-height: 250px;'>";
            }
            ?>
          </div>
        </div>
        <input type="file" id="foto-file" accept="image/*">
      </div>
      <div class="container" style="margin-bottom: 50px;">
        <?php
        if (is_null($this->id_empleado)) {
          echo '<button class="btn btn-warning" id="btn-reload-ine">
          <i class="fa-solid fa-address-card"></i>
          Volver a subir INE
        </button>';
        }
        ?>
        <button type="submit" class="btn btn-success" id="btn-send">
          <i class="fa-solid fa-check"></i>
          Enviar
        </button>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo SITE_URL ?>js/cargaINE.js"></script>
<script>
  const $fotoUser = document.getElementById("foto-user");
  const formDataFoto = new FormData();
  const $btnSend = document.getElementById("btn-send");
  const $fotoFile = document.getElementById("foto-file");

  $fotoFile.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (file) {
      const urlTemporal = URL.createObjectURL(file);
      $fotoUser.src = urlTemporal;

      // Limpieza de la URL temporal cuando ya no se necesite
      $fotoFile.onload = () => URL.revokeObjectURL(urlTemporal);
      formDataFoto.append("foto_path", file, file.name);
    }
  });

  $btnSend.addEventListener("click", (e) => {
    e.preventDefault();
    const formDataDatos = new FormData(document.getElementById("form-datos"));
    for (let [key, value] of formDataFoto.entries()) {
      formDataDatos.append(key, value);
    }

    if (formDataDatos.getAll("foto_path").length !== 0 || "<?php echo $this->peticion ?>" === "UPDATE") {
      asyncConfirmProcessForm(
        formDataDatos,
        `<?php echo SITE_URL; ?>_controller/admin/gestor_empleados/AsyncMtoEmpleados.php`,
        "Confirmación",
        "¿Está seguro de que desea hacer el registro de este empleado?",
        "¡Empleado registrado correctamente!"
      );
    } else {
      Swal.fire({
        icon: "error",
        title: "¡Error!",
        text: "Tienes que subir una foto para seguir con el registro",
      });
    }
  });
</script>
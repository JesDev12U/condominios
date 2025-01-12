<div class="container">
  <a href="<?php echo SITE_URL . RUTA_ADMINISTRADOR ?>gestor-empleados" class="btn btn-primary">
    <i class="fa-solid fa-arrow-left"></i>
  </a>
  <h1><?php echo $_SESSION["usuario"] === "empleado" ? "Configuración de la cuenta" : "Mantenimiento de empleados" ?></h1>
  <div id="formSection" class="mt-5">
    <div class="row">
      <!-- Formulario -->
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
              placeholder="<?php echo $_SESSION["usuario"] === "administrador" ? "Ingresa aquí el nombre del empleado" : "Ingresa aquí tu nombre" ?>"
              required />
            <span id="error-nombre" class="span-errors hidden">Nombre inválido</span>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label"><i class="fa-solid fa-envelope"></i>&nbsp;Correo electrónico</label>
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              value="<?php echo is_null($this->id_empleado) ? "" : $this->email ?>"
              placeholder="<?php echo $_SESSION["usuario"] === "administrador" ? "Ingresa aquí el correo electrónico del empleado" : "Ingresa aquí tu correo electrónico" ?>"
              required />
            <span id="error-email" class="span-errors hidden">Correo electrónico inválido</span>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label"><i class="fa-solid fa-lock"></i>&nbsp;Contraseña</label>
            <div class="input-group">
              <input
                data-valor="<?php echo is_null($this->id_empleado) ?>"
                type="password"
                class="form-control"
                id="password"
                name="password"
                placeholder="<?php echo $_SESSION["usuario"] === "administrador" ? "Ingresa aquí una contraseña para el empleado" : "Ingresa aquí una nueva contraseña si la deseas cambiar" ?>"
                <?php echo is_null($this->id_empleado) || $_SESSION["usuario"] === "empleado" ? "" : "disabled" ?> />
              <button class="btn btn-outline-secondary" id="toggle-password" type="button">
                <i class="fa-solid fa-eye"></i>
              </button>
            </div>
            <span id="error-password" class="span-errors hidden">Contraseña inválida</span>
          </div>
          <div class="mb-3">
            <label for="telefono" class="form-label"><i class="fa-solid fa-phone"></i>&nbsp;Teléfono</label>
            <input
              type="text"
              class="form-control"
              id="telefono"
              name="telefono"
              value="<?php echo is_null($this->id_empleado) ? "" : $this->telefono ?>"
              placeholder="<?php echo $_SESSION["usuario"] === "administrador" ? "Ingresa aquí el teléfono del empleado" : "Ingresa aquí tu teléfono" ?>"
              required />
            <span id="error-telefono" class="span-errors hidden">Teléfono inválido</span>
          </div>
          <div class="mb-3">
            <label for="telefono_emergencia" class="form-label"><i class="fa-solid fa-tower-broadcast"></i>&nbsp;Teléfono de emergencia</label>
            <input
              type="text"
              class="form-control"
              id="telefono_emergencia"
              name="telefono_emergencia"
              value="<?php echo is_null($this->id_empleado) ? "" : $this->telefono_emergencia ?>"
              placeholder="<?php echo $_SESSION["usuario"] === "administrador" ? "Ingresa aquí el teléfono de emergencia del empleado" : "Ingresa aquí tu teléfono de emergencia" ?>"
              required />
            <span id="error-telefono-emergencia" class="span-errors hidden">Teléfono inválido</span>
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
        <button type="submit" class="btn btn-success" id="btn-send" data-peticion="<?php echo $this->peticion ?>" data-url="<?php echo SITE_URL; ?>" data-usuario="<?php echo $_SESSION["usuario"] ?>" data-url_admin="<?php echo RUTA_ADMINISTRADOR ?>">
          <i class="fa-solid fa-check"></i>
          <?php echo is_null($this->id_empleado) ? "Registrar" : "Actualizar" ?>
        </button>
      </div>
    </div>
  </div>
</div>
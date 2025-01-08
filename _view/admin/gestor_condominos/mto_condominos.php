<div class="container">
  <a href="<?php echo SITE_URL . RUTA_ADMINISTRADOR ?>gestor-condominos" class="btn btn-primary">
    <i class="fa-solid fa-arrow-left"></i>
  </a>
  <div id="formSection" class="mt-5">
    <div class="row">
      <!-- Formulario -->
      <div class="col">
        <h5 class="text-center mb-4">Información Personal</h5>
        <form id="form-datos">
          <input type="hidden" name="peticion" value="<?php echo $this->peticion ?>">
          <?php if (!is_null($this->id_condomino)) echo '<input type="hidden" name="id_condomino" value="' . $this->id_condomino . '" />' ?>
          <div class="mb-3">
            <label for="nombre" class="form-label"><i class="fa-solid fa-user"></i>&nbsp;Nombre</label>
            <input
              type="text"
              class="form-control"
              id="nombre"
              name="nombre"
              value="<?php echo is_null($this->id_condomino) ? "" : $this->nombre ?>"
              placeholder="Ingresa aquí el nombre del condomino"
              required />
            <span id="error-nombre" class="span-errors hidden">El nombre no puede ser vacío</span>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label"><i class="fa-solid fa-envelope"></i>&nbsp;Correo electrónico</label>
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              value="<?php echo is_null($this->id_condomino) ? "" : $this->email ?>"
              placeholder="Ingresa aquí el correo electrónico del condomino"
              required />
            <span id="error-email" class="span-errors hidden">Correo electrónico inválido</span>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label"><i class="fa-solid fa-lock"></i>&nbsp;Contraseña</label>
            <div class="input-group">
              <input data-valor="<?php echo is_null($this->id_condomino) ?>" type="password" class="form-control" id="password" name="password" placeholder="Ingresa aquí una contraseña para el condomino" <?php echo is_null($this->id_condomino) || $_SESSION["usuario"] === "condomino" ? "" : "disabled" ?> />
              <button class="btn btn-outline-secondary" id="toggle-password" type="button">
                <i class="fa-solid fa-eye"></i>
              </button>
            </div>
            <span id="error-password" class="span-errors hidden">La contraseña no puede ser vacía</span>
          </div>
          <div class="mb-3">
            <label for="telefono" class="form-label"><i class="fa-solid fa-phone"></i>&nbsp;Teléfono</label>
            <input
              type="text"
              class="form-control"
              id="telefono"
              name="telefono"
              value="<?php echo is_null($this->id_condomino) ? "" : $this->telefono ?>"
              placeholder="Ingresa aquí el teléfono del condomid_condomino"
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
              value="<?php echo is_null($this->id_condomino) ? "" : $this->telefono_emergencia ?>"
              placeholder="Ingresa aquí el teléfono de emergencia del condomino"
              required />
            <span id="error-telefono-emergencia" class="span-errors hidden">Teléfono inválido</span>
          </div>
          <div class="mb-3">
            <label for="torre" class="form-label"><i class="fa-solid fa-tower-observation"></i>&nbsp;Torre</label>
            <input
              type="text"
              class="form-control"
              id="torre"
              name="torre"
              value="<?php echo is_null($this->id_condomino) ? "" : $this->torre ?>"
              placeholder="Ingresa aquí la torre del condomino"
              required />
            <span id="error-torre" class="span-errors hidden">La torre no puede ser vacía</span>
          </div>
          <div class="mb-3">
            <label for="departamento" class="form-label"><i class="fa-solid fa-house"></i>&nbsp;Departamento</label>
            <input
              type="text"
              class="form-control"
              id="departamento"
              name="departamento"
              value="<?php echo is_null($this->id_condomino) ? "" : $this->departamento ?>"
              placeholder="Ingresa aquí la departamento del condomino"
              required />
            <span id="error-departamento" class="span-errors hidden">El departamento no puede ser vacío</span>
          </div>
          <div class="mb-3">
            <label for="tipo" class="form-label"><i class="fa-solid fa-user-tag"></i>&nbsp;Tipo</label>
            <select name="tipo" id="tipo" class="form-control">
              <option value="Dueño"
                <?php
                if (!is_null($this->id_condomino) && $this->tipo === "Dueño")
                  echo "selected";
                ?>>Dueño</option>
              <option value="Arrendedor"
                <?php
                if (!is_null($this->id_condomino) && $this->tipo === "Arrendedor")
                  echo "selected";
                ?>>Arrendedor</option>
            </select>
          </div>
        </form>
      </div>
      <div class="col general-container-foto" style="margin-bottom: 50px;">
        <h5 class="text-center mb-4">Foto</h5>
        <div class="wrapper-foto">
          <div class="container-foto">
            <?php
            if (!is_null($this->id_condomino)) {
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
        <button type="submit" class="btn btn-success" id="btn-send" data-url="<?php echo SITE_URL ?>" data-peticion="<?php echo $this->peticion ?>" data-usuario="<?php echo $_SESSION["usuario"] ?>">
          <i class="fa-solid fa-check"></i>
          Enviar
        </button>
      </div>
    </div>
  </div>
</div>
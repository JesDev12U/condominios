<div class="container">
  <a href="<?php echo SITE_URL . RUTA_ADMINISTRADOR ?>" class="btn btn-primary">
    <i class="fa-solid fa-arrow-left"></i>
  </a>
</div>
<div id="formSection" class="mt-5">
  <!--Formulario -->
  <form id="form-datos">
    <input type="hidden" name="id_administrador" value="<?php echo $this->id_administrador ?>" />
    <div class="mb-3">
      <label for="nombre" class="form-label"><i class="fa-solid fa-user"></i>&nbsp;Nombre</label>
      <input
        type="text"
        class="form-control"
        id="nombre"
        name="nombre"
        value="<?php echo $this->nombre ?>"
        placeholder="Ingresa aquí tu nombre"
        required />
    </div>
    <div class="mb-3">
      <label for="email" class="form-label"><i class="fa-solid fa-envelope"></i>&nbsp;Correo electrónico</label>
      <input
        type="email"
        class="form-control"
        id="email"
        name="email"
        value="<?php echo $this->email ?>"
        placeholder="Ingresa aquí tu correo electrónico"
        required />
    </div>
    <div class="mb-3">
      <label for="password" class="form-label"><i class="fa-solid fa-lock"></i>&nbsp;Contraseña</label>
      <div class="input-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa aquí tu contraseña" />
        <button class="btn btn-outline-secondary" id="toggle-password" type="button">
          <i class="fa-solid fa-eye"></i>
        </button>
      </div>
    </div>
    <div class="container" style="margin-bottom: 50px;">
      <button type="submit" class="btn btn-success" id="btn-send">
        <i class="fa-solid fa-check"></i>
        Enviar
      </button>
    </div>
  </form>
</div>
<script>
  const $btnSend = document.getElementById("btn-send");
  const $formDatos = document.getElementById("form-datos");
  $btnSend.addEventListener("click", (e) => {
    e.preventDefault();
    const formDataDatos = new FormData($formDatos);
    asyncConfirmProcess(
      formDataDatos,
      `<?php echo SITE_URL; ?>_controller/admin/AsyncMtoAdministrador.php`,
      "Confirmación",
      "¿Está seguro de modificar sus datos?",
      "¡Datos modificados correctamente!"
    );
  })
</script>
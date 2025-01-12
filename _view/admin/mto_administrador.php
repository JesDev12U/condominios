<div class="container">
  <a href="<?php echo SITE_URL . RUTA_ADMINISTRADOR ?>" class="btn btn-primary">
    <i class="fa-solid fa-arrow-left"></i>
  </a>
  <h1>Configuración de la cuenta</h1>
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
        <span id="error-nombre" class="span-errors hidden">El nombre no puede ser vacío</span>
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
        <span id="error-email" class="span-errors hidden">Correo electrónico inválido</span>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label"><i class="fa-solid fa-lock"></i>&nbsp;Contraseña</label>
        <div class="input-group">
          <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa aquí una nueva contraseña si la deseas cambiar" />
          <button class="btn btn-outline-secondary" id="toggle-password" type="button">
            <i class="fa-solid fa-eye"></i>
          </button>
        </div>
        <span id="error-password" class="span-errors hidden">Contraseña inválida</span>
      </div>
      <div class="container" style="margin-bottom: 50px;">
        <button type="submit" class="btn btn-success" id="btn-send" data-url="<?php echo SITE_URL ?>">
          <i class="fa-solid fa-check"></i>
          Actualizar
        </button>
      </div>
    </form>
  </div>
</div>
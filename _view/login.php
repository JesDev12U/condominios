<!-- Contenido Principal -->
<div class="login-container">
  <div class="row w-75 mx-auto">
    <!-- Imagen Lado Izquierdo -->
    <div class="col-md-6 d-flex justify-content-center align-items-center">
      <img src="img/condominio/1_condominio.jpeg" alt="Vista general del condominio" title="Vista general del condominio" id="img-condominio" />
    </div>

    <!-- Formulario Lado Derecho -->
    <div class="col-md-6 login-box">
      <h2 class="text-center mb-4">¡BIENVENID@ A CONDOMINIOS!</h2>
      <!-- Formulario -->
      <form id="form-login" data-url="<?php echo SITE_URL ?>">
        <!-- Campo Usuario -->
        <div class="mb-3">
          <label for="email" class="form-label"><i class="fa-solid fa-envelope"></i>&nbsp;Correo electrónico</label>
          <input id="input-email" type="email" class="form-control" name="email" placeholder="Ingresa tu correo electrónico" required>
          <span id="error-email" class="span-errors hidden">Correo electrónico inválido</span>
        </div>

        <!-- Campo Contraseña -->
        <div class="mb-3">
          <label for="password" class="form-label"><i class="fa-solid fa-lock"></i>&nbsp;Contraseña</label>
          <div class="input-group">
            <input id="password" type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
            <button class="btn btn-outline-secondary" id="toggle-password" type="button">
              <i class="fa-solid fa-eye"></i>
            </button>
          </div>
          <span id="error-password" class="span-errors hidden">La contraseña no puede ser vacía</span><br>
        </div>

        <div class="mb-3 text-end">
          <a href="<?php echo SITE_URL ?>recuperar-password" class="text-decoration-none">¿Haz olvidado la contraseña?</a>
        </div>
        <div class="d-grid gap-3">
          <button id="btn-iniciar-sesion" class="btn btn-practical" disabled>Iniciar sesión</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="container">
  <a href="<?php echo SITE_URL ?>login" class="btn btn-primary">
    <i class="fa-solid fa-arrow-left"></i>
  </a>
  <h1>Recuperación de contraseña</h1>
  <div class="container" id="input-correo-container">
    <form id="emailForm">
      <input type="hidden" name="operacion" value="enviar_codigo">
      <input type="hidden" name="url" value="<?php echo SITE_URL ?>">
      <div class="mb-3">
        <label for="email" class="form-label"><i class="fa-solid fa-envelope"></i>&nbsp;Correo electrónico</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Ingresa aquí tu correo electrónico" required>
        <span id="error-email" class="span-errors hidden">Correo electrónico inválido</span>
      </div>
      <button id="btn-enviar-email" class="btn btn-primary">Enviar</button>
    </form>
  </div>
  <div class="container hidden" id="input-codigo-container">
    <div class="row justify-content-center">
      <div class="col-md-6 text-center">
        <h1 class="mb-4">Introduce tu Código de Seguridad</h1>
        <form id="securityCodeForm">
          <input type="hidden" name="operacion" value="comprobar_codigo">
          <input type="hidden" name="url" value="<?php echo SITE_URL ?>">
          <div class="d-flex justify-content-center">
            <input type="text" maxlength="1" class="form-control code-input" id="digit1" oninput="handleInput(this, 'digit2')" />
            <input type="text" maxlength="1" class="form-control code-input" id="digit2" oninput="handleInput(this, 'digit3')" />
            <input type="text" maxlength="1" class="form-control code-input" id="digit3" oninput="handleInput(this, 'digit4')" />
            <input type="text" maxlength="1" class="form-control code-input" id="digit4" oninput="handleInput(this, 'digit5')" />
            <input type="text" maxlength="1" class="form-control code-input" id="digit5" oninput="handleInput(this, '')" />
          </div>
          <button type="submit" id="submitButtonSecurityCodeForm" class="btn btn-primary mt-4" disabled>Verificar Código</button>
        </form>
      </div>
    </div>
  </div>
  <div class="container hidden" id="input-nuevapassword-container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h1 class="text-center mb-4">Cambiar Contraseña</h1>
        <form id="passwordForm">
          <input type="hidden" name="operacion" value="cambiar_password">
          <input type="hidden" name="url" value="<?php echo SITE_URL ?>">
          <div class="mb-3">
            <label for="newPassword" class="form-label">Nueva Contraseña</label>
            <input
              type="password"
              name="password"
              class="form-control"
              id="newPassword"
              placeholder="Introduce tu nueva contraseña"
              required
              oninput="validatePasswords()">
            <span id="error-password" class="span-errors hidden"></span>
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirma tu Contraseña</label>
            <input
              type="password"
              class="form-control"
              id="confirmPassword"
              placeholder="Vuelve a escribir tu contraseña"
              required
              oninput="validatePasswords()">
            <span id="error-password-confirm" class="span-errors hidden"></span>
            <div id="passwordError" class="form-text text-danger d-none">Las contraseñas no coinciden.</div>
          </div>
          <button type="submit" id="submitButtonPasswordForm" class="btn btn-primary w-100" disabled>Cambiar Contraseña</button>
        </form>
      </div>
    </div>
  </div>
</div>
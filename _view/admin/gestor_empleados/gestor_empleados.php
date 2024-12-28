<!-- Area de contenido -->
<div class="container-fluid p-4">
  <a href="<?php echo SITE_URL ?>" class="btn btn-primary">
    <i class="fa-solid fa-arrow-left"></i>
  </a>
  <br><br>
  <a href="<?php echo SITE_URL . RUTA_ADMINISTRADOR ?>mto-empleados" class="btn btn-success">
    <i class="fas fa-plus"></i>
    Agregar
  </a>
  <table id="tblDatos" class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Foto</th>
        <th>Nombre</th>
        <th>Correo electrónico</th>
        <th>Teléfono</th>
        <th>Teléfono de emergencia</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($this->datos as $reg): ?>
        <tr>
          <td><?php echo $reg["id_empleado"] ?></td>
          <td><img src="<?php echo $reg["foto_path"] ?>" class="img-users" /></td>
          <td><?php echo $reg["nombre"] ?></td>
          <td><?php echo $reg["email"] ?></td>
          <td><?php echo $reg["telefono"] ?></td>
          <td><?php echo $reg["telefono_emergencia"] ?></td>
          <td>
            <a class="btn btn-warning" href="<?php echo SITE_URL . RUTA_ADMINISTRADOR ?>mto-empleados/<?php echo $reg["id_empleado"] ?>">
              <i class="fas fa-pen"></i>
              Modificar
            </a>
            <?php
            if ($reg["habilitado"]) {
              echo '<button class="btn btn-danger" id="btn-deshabilitar" data-url="' . SITE_URL .  '" data-usuario="empleado" data-id="' . $reg["id_empleado"] . '">' .
                '<i class="fa-solid fa-ban"></i>
                Deshabilitar
              </button>';
            } else {
              echo '<button class="btn btn-success" id="btn-habilitar" data-url="' . SITE_URL .  '" data-usuario="empleado" data-id="' . $reg["id_empleado"] . '">' .
                '<i class="fa-solid fa-check"></i>
                Habilitar
              </button>';
            }
            ?>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
<script src="<?php echo SITE_URL . "js/admin/des_hab_usuarios.js" ?>"></script>
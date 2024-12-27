<!-- Area de contenido -->
<div class="container-fluid p-4">
  <a href="<?php echo SITE_URL ?>" class="btn btn-primary">
    <i class="fa-solid fa-arrow-left"></i>
    Regresar al menú principal
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
        <th>Email</th>
        <th>Teléfono</th>
        <th>Teléfono de emergencia</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php $ordinal = 0 ?>
      <?php foreach ($this->datos as $reg): ?>
        <tr>
          <td><?php echo $reg["id_empleado"] ?></td>
          <td><img src="<?php echo $reg["foto_path"] ?>" width="150" height="150" /></td>
          <td><?php echo $reg["nombre"] ?></td>
          <td><?php echo $reg["email"] ?></td>
          <td><?php echo $reg["telefono"] ?></td>
          <td><?php echo $reg["telefono_emergencia"] ?></td>
          <td>
            <a class="btn btn-warning" href="<?php echo SITE_URL . RUTA_ADMINISTRADOR ?>mto-empleados/<?php echo $reg["id_empleado"] ?>">
              <i class="fas fa-pen"></i>
              Modificar
            </a>
            <a class="btn btn-danger" href="javascript:eliminarRegistro(<?php echo $ordinal++ ?>, <?php echo $reg["id_empleado"] ?>)">
              <i class="fas fa-trash"></i>
              Eliminar
            </a>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
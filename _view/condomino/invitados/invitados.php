<!-- Area de contenido -->
<div class="container-fluid p-4">
  <a href="<?php echo SITE_URL ?>" class="btn btn-primary">
    <i class="fa-solid fa-arrow-left"></i>
  </a>
  <br><br>
  <a href="<?php echo SITE_URL . RUTA_CONDOMINO ?>mto-invitados" class="btn btn-success">
    <i class="fas fa-plus"></i>
    Agregar
  </a>
  <table id="tblDatos" class="table table-striped">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Horario inicial</th>
        <th>Horario final</th>
        <th>QR</th>
        <th>Número de integrantes</th>
        <th>Asunto</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($this->datos as $reg): ?>
        <tr>
          <td><?php echo $reg["nombre"] ?></td>
          <td><?php echo $reg["horario_inicio"] ?></td>
          <td><?php echo $reg["horario_final"] ?></td>
          <td><?php echo $reg["json_qr"] ?></td>
          <td><?php echo $reg["integrantes"] ?></td>
          <td><?php echo $reg["asunto"] ?></td>
          <td>
            <a href="" class="btn btn-warning">
              <i class="fas fa-pen"></i>
              Modificar
            </a>
            <a href="" class="btn btn-danger">
              <i class="fa-solid fa-eye-slash"></i>
              Ocultar
            </a>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
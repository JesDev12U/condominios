<!-- Area de contenido -->
<div class="container-fluid p-4">
  <a href="<?php echo SITE_URL ?>" class="btn btn-primary">
    <i class="fa-solid fa-arrow-left"></i>
  </a>
  <br><br>
  <table id="tblDatos" class="table table-striped">
    <thead>
      <th>Nombre del condomino</th>
      <th>Nombre del invitado</th>
      <th>Fecha</th>
      <th>Horario de entrada</th>
      <th>Horario de salida</th>
      <th>Asunto</th>
      <th>Integrantes</th>
    </thead>
    <tbody>
      <?php foreach ($this->datos as $reg): ?>
        <tr>
          <td><?php echo $reg["nombre_condomino"] ?></td>
          <td><?php echo $reg["nombre_invitado"] ?></td>
          <td><?php echo $reg["fecha"] ?></td>
          <td><?php echo $reg["horario_entrada"] ?></td>
          <td><?php echo $reg["horario_salida"] ?? "No ha salido" ?></td>
          <td><?php echo $reg["asunto"] ?></td>
          <td><?php echo $reg["integrantes"] ?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
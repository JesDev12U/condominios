<!-- Area de contenido -->
<div class="container-fluid p-4">
  <a href="<?php echo SITE_URL ?>" class="btn btn-primary">
    <i class="fa-solid fa-arrow-left"></i>
  </a>
  <br><br>
  <p>Exporta la tabla</p>
  <table id="tblReservaciones" class="table table-striped">
    <thead>
      <tr>
        <th>Foto</th>
        <th>ID del evento</th>
        <th>ID del condomino</th>
        <th>Nombre del condomino</th>
        <th>Cantidad de personas</th>
        <th>Fecha</th>
        <th>Turno</th>
        <th>Detalles</th>
        <th>Tipo</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($this->datos as $reg): ?>
        <tr>
          <td><img src="<?php echo $reg["foto_path"] ?>" class="img-users" /></td>
          <td><?php echo $reg["id_evento"] ?></td>
          <td><?php echo $reg["id_condomino"] ?></td>
          <td><?php echo $reg["nombre"] ?></td>
          <td><?php echo $reg["cantidad_personas"] ?></td>
          <td><?php echo $reg["fecha"] ?></td>
          <td><?php echo $reg["turno"] ?></td>
          <td><?php echo $reg["detalles_evento"] ?></td>
          <td><?php echo $reg["tipo_evento"] ?></td>
          <td>
            <?php
            if ($reg["cancelado"]) {
              echo '<button class="btn btn-success" id="btn-reagendar" data-url="' . SITE_URL .  '" data-id_evento="' . $reg["id_evento"] . '" data-id_condomino="' . $reg["id_condomino"] . '">' .
                '<i class="fa-solid fa-calendar"></i>
                Reagendar
              </button>';
            } else {
              echo '<button class="btn btn-danger" id="btn-cancelar" data-url="' . SITE_URL .  '" data-id_evento="' . $reg["id_evento"] . '" data-id_condomino="' . $reg["id_condomino"] . '">' .
                '<i class="fa-solid fa-ban"></i>
                Cancelar
              </button>';
            }
            ?>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
<script src="<?php echo SITE_URL . "js/condomino/reservar_eventos.js" ?>"></script>
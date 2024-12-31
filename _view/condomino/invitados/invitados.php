<?php

use chillerlan\QRCode\{QRCode, QROptions};
?>
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
        <tr id="registro<?php echo $reg["id_invitado"] ?>" class="<?php echo $reg["ocultar"] ? "ocultar" : "" ?>">
          <td><?php echo $reg["nombre"] ?></td>
          <td><?php echo $reg["horario_inicio"] ?></td>
          <td><?php echo $reg["horario_final"] ?></td>
          <td>
            <button id="btn-qr<?php echo $reg["id_invitado"] ?>" <?php echo $reg["ocultar"] ? "disabled" : "" ?> type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $reg["id_invitado"] ?>">
              <i class="fa-solid fa-qrcode"></i> Ver QR
            </button>
            <div class="modal fade" id="exampleModal<?php echo $reg["id_invitado"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">QR de <?php echo $reg["nombre"] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <?php
                    $qrcode = (new QRCode)->render($reg["json_qr"]);
                    printf('<img src="%s" alt="QR Code" />', $qrcode);
                    ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <form method="POST" action="<?php echo SITE_URL ?>_controller/condomino/invitados/AsyncPDFQR.php">
                      <input type="hidden" name="id_invitado" value="<?php echo $reg["id_invitado"] ?>">
                      <input type="hidden" name="json_qr" value="<?php echo $reg["json_qr"] ?>">
                      <button type="submit" class="btn btn-primary"><i class="fa-solid fa-file-pdf"></i> Generar PDF </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </td>
          <td><?php echo $reg["integrantes"] ?></td>
          <td><?php echo $reg["asunto"] ?></td>
          <td>
            <a href="<?php echo SITE_URL . RUTA_CONDOMINO ?>mto-invitados/<?php echo $reg['id_invitado'] ?>" class="btn btn-warning">
              <i class="fas fa-pen"></i>
              Modificar
            </a>
            <?php
            if ($reg["ocultar"]) {
              echo "<button class='btn btn-success' id='btn-desocultar' data-url=" . SITE_URL . " data-id=" . $reg["id_invitado"] . ">
                <i class='fa-solid fa-eye'></i>
                Desocultar
              </button>";
            } else {
              echo "<button class='btn btn-danger' id='btn-ocultar' data-url=" . SITE_URL . " data-id=" . $reg["id_invitado"] . ">
                <i class='fa-solid fa-eye-slash'></i>
                Ocultar
              </button>";
            }
            ?>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
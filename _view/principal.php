<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
  <div class="carousel-indicators">
    <?php
    for ($i = 0; $i < count($this->imagenes); $i++) {
      if ($i === 0) {
        echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>';
        continue;
      }
      echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="' . $i . '" aria-label="Slide ' . $i . '"></button>';
    }
    ?>
  </div>
  <div class="carousel-inner">
    <?php
    for ($i = 0; $i < count($this->imagenes); $i++) {
      if ($i === 0) echo '<div class="carousel-item active">';
      else echo '<div class="carousel-item">';
      echo '<div class="mirror-container">';
      echo '<img src="' . $this->pathImagenes . '' . $this->imagenes[$i] . '" class="d-block mx-auto w-50" alt="' . $this->imagenes[$i] . '">';
      echo '</div>';
      echo '</div>';
    }
    ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<div class="container-fluid" id="contenido">
  <h1 class="text-center">¡Bienvenid@ a condominios!</h1>
  <hr>
  <h2 id="detalles-establecimiento">Detalles del establecimiento</h2>
  <div class="container">
    <div class="row">
      <div class="col text-center">
        <img src="<?php echo SITE_URL ?>img/logo.png" alt="Logo" id="img-logo">
      </div>
      <div class="col">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro totam aliquam accusantium eius perspiciatis magni nam facilis nesciunt, quis quibusdam harum fugiat sapiente similique illo, deserunt consectetur rerum quod vero?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro totam aliquam accusantium eius perspiciatis magni nam facilis nesciunt, quis quibusdam harum fugiat sapiente similique illo, deserunt consectetur rerum quod vero?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro totam aliquam accusantium eius perspiciatis magni nam facilis nesciunt, quis quibusdam harum fugiat sapiente similique illo, deserunt consectetur rerum quod vero?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro totam aliquam accusantium eius perspiciatis magni nam facilis nesciunt, quis quibusdam harum fugiat sapiente similique illo, deserunt consectetur rerum quod vero?</p>
      </div>
    </div>
  </div>
  <hr>
  <h2 id="eventos">Eventos</h2>
  <h3><i>Próximos</i></h3>
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
    if ($this->proximosEventos) {
      foreach ($this->proximosEventos as $evento) {
        echo "<div class='col'>
        <div class='card'>
          <img src='" . $evento["foto_path"] . "' class='card-img-top'>
          <div class='card-body'>
            <h5 class='card-title'><strong>" . $evento["tipo_evento"] . "</strong></h5>
            <p class='card-text'>
              <strong>Fecha: </strong>" . $evento["fecha"] . "
            </p>
            <p class='card-text'>
              <strong>Turno: </strong>" . $evento["turno"] . "
            </p>
            <p class='card-text'>
              " . $evento["detalles_evento"] . "
            </p>
          </div>
        </div>
      </div>";
      }
    } else {
      echo "<div class='col'>No hay eventos por mostrar</div>";
    }
    ?>
  </div>
  <h3><i>Anteriores</i></h3>
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
    if ($this->anterioresEventos) {
      foreach ($this->anterioresEventos as $evento) {
        echo "<div class='col'>
        <div class='card'>
          <img src='" . $evento["foto_path"] . "' class='card-img-top'>
          <div class='card-body'>
            <h5 class='card-title'><strong>" . $evento["tipo_evento"] . "</strong></h5>
            <p class='card-text'>
              <strong>Fecha: </strong>" . $evento["fecha"] . "
            </p>
            <p class='card-text'>
              <strong>Turno: </strong>" . $evento["turno"] . "
            </p>
            <p class='card-text'>
              " . $evento["detalles_evento"] . "
            </p>
          </div>
        </div>
      </div>";
      }
    } else {
      echo "<div class='col'>No hay eventos por mostrar</div>";
    }
    ?>
  </div>
</div>
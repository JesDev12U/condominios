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
      echo '<img src="' . $this->pathImagenes . '' . $this->imagenes[$i] . '" class="d-block w-100" alt="' . $this->imagenes[$i] . '">';
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
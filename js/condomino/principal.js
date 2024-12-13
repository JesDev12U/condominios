document.addEventListener("DOMContentLoaded", () => {
  sesion(
    `<?php echo json_encode(["sesion" => $_SESSION]) ?>`,
    `<?php echo SITE_URL ?>`
  );
  return;
});

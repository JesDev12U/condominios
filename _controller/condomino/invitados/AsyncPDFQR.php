<?php

use chillerlan\QRCode\{QRCode, QROptions};

ini_set('display_errors', E_ALL); // Solo para pruebas
require_once __DIR__ . '/../../../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  echo "Peticion invalida";
  die();
}

$json_qr = isset($_POST['json_qr']) ? $_POST['json_qr'] : null;
$id_invitado = isset($_POST['id_invitado']) ? $_POST['id_invitado'] : null;
if (!$json_qr || !$id_invitado) {
  echo "Datos no recibidos";
  die();
}

// Generar QR y guardarlo como SVG
$qrcodeSvg = "../../../uploads/tmpqr_$id_invitado.svg";
$qrcode = (new QRCode)->render($json_qr, $qrcodeSvg);

// Convertir SVG a PNG
$pngFile = "../../../uploads/tmpqr_$id_invitado.png";
if (extension_loaded('imagick')) {
  $imagick = new Imagick();
  $imagick->setBackgroundColor(new ImagickPixel('transparent'));
  $imagick->readImage($qrcodeSvg);
  $imagick->setImageFormat("png");
  $imagick->writeImage($pngFile);
  $imagick->clear();
  $imagick->destroy();
} else {
  echo "Imagick no está disponible. No se puede convertir el SVG a PNG.";
  die();
}

class PDF extends \tFPDF
{
  function Header()
  {
    $this->SetFont('DejaVu', '', 12);
    $this->Cell(0, 10, '¡QR Generado con Éxito!', 0, 1, 'C');
  }

  function Footer()
  {
    $this->SetY(-15);
    $this->SetFont('DejaVu', '', 8);
    $this->Cell(0, 10, 'Condominios', 0, 0, 'C');
  }

  function TitleSection($title)
  {
    $this->SetFont('DejaVu', '', 16);
    $this->Cell(0, 10, $title, 0, 1, 'C');
  }

  function SubtitleSection($subtitle)
  {
    $this->SetFont('DejaVu', '', 12);
    $this->MultiCell(0, 10, $subtitle, 0, 'C');
  }

  function ImageSection($imgUrl)
  {
    $this->Image($imgUrl, 70, 60, 70); // Ajustar posición y tamaño
  }
}

// Crear PDF e incluir la imagen PNG
$pdf = new PDF();
$pdf->AddFont('DejaVu', '', '../../../../../fonts/dejavu-sans/DejaVuSans.ttf', true);
$pdf->AddFont('DejaVu', 'B', '../../../../../fonts/dejavu-sans/DejaVuSans-Bold.ttf', true);
$pdf->AddFont('DejaVu', 'I', '../../../../../fonts/dejavu-sans/DejaVuSans-Oblique.ttf', true);
$pdf->AddPage();
$pdf->TitleSection('Escaneo de QR');
$pdf->SubtitleSection('Con este QR, tu invitado podrá ingresar al establecimiento');
$pdf->ImageSection($pngFile);
$pdf->Output();

// Eliminar archivos temporales
unlink($qrcodeSvg);
unlink($pngFile);

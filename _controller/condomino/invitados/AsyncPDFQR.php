<?php

use chillerlan\QRCode\{QRCode, QROptions};

ini_set('display_errors', E_ALL); // Solo para pruebas
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . "/../../../config/Global.php";
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: " . SITE_URL . RUTA_CONDOMINO . "invitados");
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

// Fuentes
define('QUICKLESS_FONT', TCPDF_FONTS::addTTFfont(__DIR__ . '/../../../fonts/quickless/Quickless.ttf', 'TrueTypeUnicode', '', 96));
//var_dump($quickless);
class PDF extends \TCPDF
{ 
  public function Header()
  {
    // Ruta del logo
    $logoPath = '../../../img/logo.png';
    // Posición del logo (X, Y) y tamaño (ancho, alto)
    $this->Image($logoPath, 10, 6, 15);
    // Establecer la fuente para el título
    $this->SetFont(QUICKLESS_FONT, '', 15, '', false);
    // Mover a la derecha
    $this->Cell(33);
    // Título
    $this->Cell(2, 25, 'Condominios', 0, 1, 'C');
  }

  function Footer()
  {
    $this->SetY(-15);
    //$this->SetFont('DejaVu', '', 8);
    $this->Cell(0, 10, 'Condominios', 0, 0, 'C');
  }

  function TitleSection($title)
  {
    //$this->SetFont('DejaVu', 'B', 18);
    $this->Cell(0, 40, $title, 0, 1, 'C');
  }

  function SubtitleSection($subtitle)
  {
    //$this->SetFont('DejaVu', 'I', 12);
    $this->MultiCell(0, 2, $subtitle, 0, 'C');
  }

  function ImageSection($imgUrl)
  {
    $this->ImageSVG($file=$imgUrl, $x=20, $y=65, $w='60', $h='60', $link='', $align='', $palign='', $border=1, $fitonpage=false);
  }
}

// Crear PDF e incluir la imagen PNG
$pdf = new PDF('P', 'mm', array(100, 150)); // Ancho: 100mm, Alto: 150mm
$pdf->AddPage();
$pdf->TitleSection('¡QR generado con éxito!');
$pdf->SubtitleSection('Con este QR, tu invitado podrá ingresar al establecimiento');
$pdf->ImageSection($qrcodeSvg);
$pdf->Output();

// Eliminar archivos temporales
unlink($qrcodeSvg);

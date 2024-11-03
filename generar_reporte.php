<?php
require_once 'config/database.php';
require 'vendor/autoload.php';
require_once('vendor/tecnickcom/tcpdf/tcpdf.php');
require_once('includes/functions.php');

$id = $_GET['id'] ?? null;
$Infraccion = obtenerInfraccionPorId($id);

if (!$Infraccion) {
    die("Infracción no encontrada.");
}

$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Municipalidad Provincial Calca');
$pdf->SetTitle('Reporte de Infracción Municipalidad Provincial Calca');
$pdf->SetHeaderData('', 0, 'Reporte de Infracción', 'Detalles de la infracción');

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(15, 27, 15);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();


$html = '<style>
            .center {
                text-align: left;
            }

            .left {
                text-align: left;
            }    
         </style>';
$html .= '<div class="center">';
$html .= '<h1>Reporte de Infracción</h1>';
$html .= '<p><strong>Estimado/a: </strong><p/>';
$html .= '<p>Le informamos que dada la situacion Usted esta siendo ';
$html .= 'noticado/a con la siguiente infracción: </p>';
$html .= '<p><strong>Infracción:</strong> ' . htmlspecialchars($Infraccion['infraccion']) . '</p>';
$html .= '<p><strong>Descripción:</strong> ' . htmlspecialchars($Infraccion['descripcion']) . '</p>';
$html .= '<p><strong>Fecha de Entrega:</strong> ' . formatDate($Infraccion['fechaEntrega']) . '</p>';
$html .= '<p><strong>Costo de Infracción:</strong> S/.' . number_format($Infraccion['costo_infraccion'], 2) . '</p>';
$html .= "</div>";


$html .= '<div class="left">';
$html .= '<p>Agradecemos que tome las medidas necesarias para regularizar su situación a la brevedad posible.</p>';
$html .= '<p>Si tiene alguna consulta o desea más información, no dude en comunicarse con nuestra oficina.</p>';
$html .= '<p>Atentamente: </p>';
$html .= '<p>Municipalidad Provincial Calca</p>';
$html .= "</div>";

$pdf->writeHTML($html, true, false, true, false, '');


$pdf->Output('reporte_infraccion.pdf', 'I');
?>
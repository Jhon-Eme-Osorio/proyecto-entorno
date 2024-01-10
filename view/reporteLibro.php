<?php
require_once('tcpdf/tcpdf.php'); //Llamando a la Libreria TCPDF
require_once('config/conexion.php'); //Llamando a la conexión para BD
date_default_timezone_set('Europa/Berling');


ob_end_clean(); //limpiar la memoria


class MYPDF extends TCPDF
{

    public function Header()
    {
        $bMargin = $this->getBreakMargin();
        $auto_page_break = $this->AutoPageBreak;
        $this->SetAutoPageBreak(false, 0);
        $img_file = dirname(__FILE__) . '/assets/img/logo.png';
        $this->Image($img_file, 85, 8, 20, 25, '', '', '', false, 30, '', false, false, 0);
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        $this->setPageMark();
    }
}


//Iniciando un nuevo pdf
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'mm', 'Letter', true, 'UTF-8', false);

//Establecer margenes del PDF
$pdf->SetMargins(20, 35, 25);
$pdf->SetHeaderMargin(20);
$pdf->setPrintFooter(false);
$pdf->setPrintHeader(true); //Eliminar la linea superior del PDF por defecto
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM); //Activa o desactiva el modo de salto de página automático

//Informacion del PDF
$pdf->SetCreator('Jhon eme');
$pdf->SetAuthor('Jhon eme');
$pdf->SetTitle('Informe de Empleados');

/** Eje de Coordenadas
 *          Y
 *          -
 *          - 
 *          -
 *  X ------------- X
 *          -
 *          -
 *          -
 *          Y
 * 
 * $pdf->SetXY(X, Y);
 */

//Agregando la primera página
$pdf->AddPage();
$pdf->SetFont('helvetica', 'B', 10); //Tipo de fuente y tamaño de letra
$pdf->SetXY(150, 20);
$pdf->Write(0, 'Fecha: ' . date('d-m-Y'));
$pdf->SetXY(150, 25);
$pdf->Write(0, 'Hora: ' . date('h:i A'));

$canal = 'WebDeveloper';
$pdf->SetFont('helvetica', 'B', 10); //Tipo de fuente y tamaño de letra
$pdf->SetXY(15, 20); //Margen en X y en Y
$pdf->SetTextColor(0, 0, 0);
$pdf->Write(0, 'Desarrollador: Jhon Maro Payan');



$pdf->Ln(35); //Salto de Linea
$pdf->Cell(40, 26, '', 0, 0, 'C');
/*$pdf->SetDrawColor(50, 0, 0, 0);
$pdf->SetFillColor(100, 0, 0, 0); */
$pdf->SetTextColor(34, 68, 136);
//$pdf->SetTextColor(255,204,0); //Amarillo
//$pdf->SetTextColor(34,68,136); //Azul
//$pdf->SetTextColor(153,204,0); //Verde
//$pdf->SetTextColor(204,0,0); //Marron
//$pdf->SetTextColor(245,245,205); //Gris claro
//$pdf->SetTextColor(100, 0, 0); //Color Carne
$pdf->SetFont('helvetica', 'B', 15);
$pdf->Cell(80, 6, 'LISTA DE LIBROS', 0, 0, 'C');


$pdf->Ln(10); //Salto de Linea
$pdf->SetTextColor(0, 0, 0);

$nuevaPosX = 15; // Ajusta este valor según sea necesario
$pdf->SetX($nuevaPosX);

//Almando la cabecera de la Tabla
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('helvetica', 'B', 12); //La B es para letras en Negritas
$pdf->Cell(52, 6, 'Titulo', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'Autor', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'Disponibilidad', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'Ejemplares', 1, 1, 'C', 1);
/*El 1 despues de  correo indica que hasta alli 
llega la linea */

$pdf->SetFont('helvetica', '', 10);


//SQL para consultas Libros
$libro = $this->model->listaLibros();

foreach ($libro as $key):
    $nombreCompleto = $key->Nombre . " " . $key->Apellido;
    $pdf->SetX($nuevaPosX);
    $pdf->Cell(52, 6, ($key->Titulo), 1, 0, 'C');
    $pdf->Cell(40, 6, $nombreCompleto, 1, 0, 'C');
    $pdf->Cell(40, 6, ($key->Disponibilidad), 1, 0, 'C');
    $pdf->Cell(40, 6, ($key->Ejemplares), 1, 1, 'C');

endforeach;

//$pdf->AddPage(); //Agregar nueva Pagina

$pdf->Output('Reporte_Libros_' . date('d_m_y') . '.pdf', 'I');
// Output funcion que recibe 2 parameros, el nombre del archivo, ver archivo o descargar,
// La D es para Forzar una descarga

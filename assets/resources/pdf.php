<?php
include '../assets/resources/fpdf.php';

    
class PDF extends FPDF
{   
    protected $idalerta;
    protected $fechaalert;
    protected$idusuario;
    protected$usnombre;
    protected$descripcion;
    protected $ubicacion;
    protected $fecha;
    protected $latitud;
    protected $longitud;   
           
            
     
function Header()
{
    global $title;
    $title="Secure Code";
    $this->Image('../assets/img/secure.png', 10,18,20,20);
    $this->Ln(10);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Calculamos ancho y posición del título.
    $w = $this->GetStringWidth($title)+6;
    $this->SetX((210-$w)/2);
    // Colores de los bordes, fondo y texto
    
    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(0,0,0);
    // Ancho del borde (1 mm)
    $this->SetLineWidth(1);
    // Título
    $this->Cell($w,9,"Secure Code",1,1,'C',true);
    // Salto de línea
    $this->Ln(10);
}

function Footer()
{
    // Posición a 1,5 cm del final
    $this->SetY(-15);
    // Arial itálica 8
    $this->SetFont('Arial','I',8);
    // Color del texto en gris
    $this->SetTextColor(128);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo(),0,0,'C');
}


function ChapterTitle($num, $label)
{
    $fecha= date("d"). "/". date("m"). "/". date("Y") ;
    // Arial 12
    $this->SetFont('Arial','',12);
    // Color de fondo
    $this->SetFillColor(200,220,255);
    // Título
    $this->Cell(0,6,'Detalle de alerta                                                                                                          '.$fecha,0,1,'L',true);
    // Salto de línea
    $this->Ln(4);
}




function ChapterBody($fecha,$idalerta,$fechaalert,$idusuario,$usnombre,$descripcion,$latitude,$longitude)
{   session_start();
    
    $this->idalerta;
    $fechaalert=$fechaalert;
    $idusuario=$idusuario;
    $usnombre=$usnombre;
    $descripcion=$descripcion;
    $latitud=$latitude;
    $longitud=$longitude;
    $ubicacion=$longitude." ".$latitude;
    $urlimg= "https://maps.googleapis.com/maps/api/staticmap?center=".$latitud.",".$longitud."&size=600x300&markers=color:red%7C".$latitud.",".$longitud."&key=AIzaSyDg6py7cZHPkgOHPZ3TdbTC5s6dB70_D9I";
    // Times 12
    $this->SetFont('Times','',12);
    // Imprimimos el texto justificado
    $this->MultiCell(0,5,"Clave de alerta: ".$idalerta);
    $this->MultiCell(0,5,"Fecha: ".$fechaalert);
    $this->MultiCell(0,5,"Clave de usuario emisor: ".$idusuario);
    $this->MultiCell(0,5,"Nombre de emisor: ".$usnombre);
    $this->MultiCell(0,5,utf8_decode( "Descripción: ".$descripcion));
    $this->MultiCell(0,5, utf8_decode("Ubicación: ".$ubicacion));
    $this->MultiCell(0,5, utf8_decode("Direccion: ".$_SESSION['infoDomicilio']));
    $this->MultiCell(0,5, utf8_decode("Mapa "));
    $this->Ln(80);
    $this->Image($urlimg,40,90,90,0,'PNG');
    // Salto de línea
    
    // Cita en itálica
    $this->SetFont('','I');

    $w = $this->GetStringWidth("Secure Code®")+6;
    $this->SetX((210-$w)/2);

    // Título
    $this->Cell($w,9,utf8_decode("Secure Code®"),0,0,true);

  
        
}

function PrintChapter($num, $titulo,$fecha,$idalerta,$fechaalert,$idusuario,$usnombre,$descripcion,$latitude,$longitude)
{               
    $this->AddPage();
    $this->ChapterTitle($num,$titulo);
    $this->ChapterBody($fecha,$idalerta,$fechaalert,$idusuario,$usnombre,$descripcion,$latitude,$longitude);


}


}

function pintarPDF($num, $titulo,$fecha,$idalerta,$fechaalert,$idusuario,$usnombre,$descripcion,$latitude,$longitude){
    $pdf = new PDF();
    $title = 'Secure Code';
    $pdf->SetTitle($title);
    $pdf->PrintChapter(1,$titulo,$fecha,$idalerta,$fechaalert,$idusuario,$usnombre,$descripcion,$latitude,$longitude);
    $pdf->Output();
}



  




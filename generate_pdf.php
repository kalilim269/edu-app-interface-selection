
<?php
include_once ("includes/config.php");;//connection to database
include_once('fpdf/fpdf.php');
include_once 'loginfunctions.php';

if (isset($_SESSION['user']))  { 

    $user = $_SESSION['user']['fld_user_num'];
}

//SQL to get 10 records
$config = new Config();
$db = $config->getConnection();
$sql = "SELECT * FROM tbl_eduapp_alternative_data WHERE user_id=$user";

class PDF extends FPDF
{
// Page header
function Header()
{

    $this->SetFont('Arial','B',18);
    // Move to the right
    $this->Cell(55);
    // Title
    $this->Cell(80,10,'AHP Summary Report',0,0,'C');
    // Line break
    $this->Ln(20);


}

// Page footer
function Footer()
{
    $this->SetY(-10);
    $this->SetFont('helvetica','I',7);

    $this->SetXY(100,-22);
    $this->Cell(100,15,'1',0,0,'L');



}
}

function __construct($db) {
	$this->conn = $db;
}

$pdf = new PDF(); 
$pdf->AddPage();

$width_cell=array(20,80,30,30,30);
$pdf->SetFont('Arial','B',12);

//Background color of header//
$pdf->SetFillColor(255, 228, 225);

// Header starts /// 

//First header column //
$pdf->Cell($width_cell[0],10,'ID',1,0,'C',true);
//Second header column//
$pdf->Cell($width_cell[1],10,'Alternative Name',1,0,'C',true);
//Third header column//
$pdf->Cell($width_cell[2],10,'Eigenvalue',1,0,'C',true); 
//Fourth header column//
$pdf->Cell($width_cell[3],10,'GM',1,0,'C',true);
//Third header column//
$pdf->Cell($width_cell[4],10,'AN',1,1,'C',true); 
//// header ends ///////

$pdf->SetFont('Arial','',12);
//Background color of header//
$pdf->SetFillColor(235,236,236); 
//to give alternate background fill color to rows// 
$fill=false;

/// each record is one row  ///
foreach ($db->query($sql) as $row) {
$pdf->Cell($width_cell[0],10,$row['alt_id'],1,0,'C',$fill);
$pdf->Cell($width_cell[1],10,$row['alt_name'],1,0,'L',$fill);

$pdf->Cell($width_cell[2],10, number_format($row['em_result'], 4,'.', ','),1,0,'C',$fill);
$pdf->Cell($width_cell[3],10, number_format($row['gm_result'], 4, '.', ','),1,0,'C',$fill);
$pdf->Cell($width_cell[4],10, number_format($row['an_result'], 4, '.', ','),1,1,'C',$fill);
//to give alternate background fill  color to rows//
$fill = !$fill;
}
/// end of records /// 

$pdf->Output();
?>
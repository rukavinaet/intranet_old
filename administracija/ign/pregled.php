<?php include_once '../../meta/con1.rg.php';
if (isset($_GET['IGNDID'])) {
  $ID_todo_view = mysqli_real_escape_string($conn, $_GET['IGNDID']);
  $sql_todo_view = "SELECT * FROM IGN WHERE IGNDID='$ID_todo_view'";

  $result_todo_view = mysqli_query($conn, $sql_todo_view);
  $row_todo_view = mysqli_fetch_array($result_todo_view);
} else {
  header('Location: https://00.intranet.rukavinagroup.com/');
}
ob_end_clean();
require('../../meta/fpdf184/fpdf.php');
$ID = $row_todo_view['IGNDID'];

class PDF extends FPDF {

  function Header() {}
  function Footer() {
   
    // Go to 1.5 cm from bottom
    $this->SetY(-15);
    // Select Arial italic 8
    $this->SetFont('Helvetica','I',8);
    // Print centered page number
    $this->Cell(0,10,  $GLOBALS['ID']. ' | Rukavina Group - IGN | Stranica '.$this->PageNo().'/{nb}',0,0,'C');
  }
}
// Instantiate and use the FPDF class 
$pdf = new PDF();
$pdf->AliasNbPages();

// Page footer
//Add a new page
$pdf->AddPage();
$datum = $row_todo_view['DocDate'];
$autor = $row_todo_view['DocSender'];
$naslov = $row_todo_view['DocTitle'];
$text = $row_todo_view['DocText'];
$pdf->SetAuthor('Rukavina Group interni sustavi');
$pdf->SetTitle('IGN - ' . $ID);
// Set the font for the text
// Prints a cell with given text 
$pdf->SetTextColor(194, 8, 8);
$pdf->SetFont('Helvetica', '', 19);
$pdf->Write(0, 'Rukavina Group Intranet | IGN');
$pdf->SetTextColor(51, 51, 51);
$pdf->Line(10, 15, 140 - 20, 15);
$pdf->Ln(6);
$pdf->SetFont('Helvetica', '', 13);
$pdf->Write(4, 'Datum obavijesti: ' . $datum);
$pdf->Ln();
$pdf->Write(4, 'Posiljatelj: ' . $autor);
$pdf->Ln();
$pdf->Write(4, 'Identifikator: ' . $ID);
$pdf->Ln();
$pdf->Write(4, 'Naslov: ' . $naslov);
$pdf->SetTextColor(51, 51, 51);
$pdf->Line(10, 33, 140 - 20, 33);
$pdf->Ln(9);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Helvetica', '', 11);
$pdf->MultiCell(190, 5, $text, 0, 'L');
// return the generated output
$pdf->Output($ID . '-rg-ign.pdf', 'I');

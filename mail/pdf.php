<?php include_once 'meta/con1.rg.php';
if (isset($_GET['MSGID'])) {
  $ID_todo_view = mysqli_real_escape_string($conn, $_GET['MSGID']);
  $sql_todo_view = "SELECT * FROM DM WHERE MSGID='$ID_todo_view'";

  $result_todo_view = mysqli_query($conn, $sql_todo_view);
  $row_todo_view = mysqli_fetch_array($result_todo_view);
} else {
  header('Location: https://00.intranet.rukavinagroup.com/');
}
ob_end_clean();
require('meta/fpdf184/fpdf.php');
$ID = $row_todo_view['MSGID'];

class PDF extends FPDF {

  function Header() {}
  function Footer() {
   
    // Go to 1.5 cm from bottom
    $this->SetY(-15);
    // Select Arial italic 8
    $this->SetFont('Helvetica','I',8);
    // Print centered page number
    $this->Cell(0,10,  $GLOBALS['ID']. ' | Rukavina Group - Dnevni Mail | Stranica '.$this->PageNo().'/{nb}',0,0,'C');
  }
}
// Instantiate and use the FPDF class 
$pdf = new PDF();
$pdf->AliasNbPages();

// Page footer
//Add a new page
$pdf->AddPage();
$today = date('d.m.Y');
$msg1 = $row_todo_view['TextMsg'];
$msgText = strip_tags($msg1);
$msg = iconv("UTF-8","ISO-8859-1//TRANSLIT",$msgText);


$msgT = $row_todo_view['MailTitle'];
//$msgTe = iconv("UTF-8","ISO-8859-1//IGNORE",$msgT);
$msgTe = iconv("UTF-8","ISO-8859-1//TRANSLIT",$msgT);

$dayy = $row_todo_view['DateMsgHuman'];
$sender = $row_todo_view['MailSender'];
$type = $row_todo_view['MailType'];
$pdf->SetAuthor('Rukavina Group interni sustavi');
$pdf->SetTitle('Dnevni-mail-' . $ID);
// Set the font for the text
// Prints a cell with given text 
$pdf->SetTextColor(194, 8, 8);
$pdf->SetFont('Helvetica', '', 19);
$pdf->Write(0, 'Rukavina Group Intranet | Dnevni Mail');
$pdf->SetTextColor(51, 51, 51);
$pdf->Line(10, 15, 145 - 20, 15);
$pdf->Ln(6);
$pdf->SetFont('Helvetica', '', 13);
$pdf->Write(4, 'Datum PDF-a: ' . $today);
$pdf->Ln();
$pdf->Write(4, 'Za datum: ' . $dayy);
$pdf->Ln();
$pdf->Write(4, 'Posiljatelj: ' . $sender);
$pdf->Ln();
$pdf->Write(4, 'Tip: ' . $type);
$pdf->Ln();
$pdf->Write(4, 'Identifikator: ' . $ID);
$pdf->Ln();
$pdf->Write(4, 'Naslov: ' . $msgTe);
$pdf->SetTextColor(51, 51, 51);
$pdf->Line(10, 40.5, 145 - 20, 40.5);
$pdf->Ln(9);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Helvetica', '', 11);
$pdf->MultiCell(190, 5, $msg, 0, 'L');
// return the generated output
$pdf->Output($ID . '-rg-dm.pdf', 'I');

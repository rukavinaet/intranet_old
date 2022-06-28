<?php include_once '../meta/con1.rg.php';

$today = date('Y-m-d');
$sql_day = "SELECT * FROM `DM` WHERE DateMsg = '$today' AND StatusMsg = 'none' ORDER BY `MailTitle` ASC";
$result_day = mysqli_query($conn, $sql_day);

$today1 = date('Y-m-d', strtotime("+1 day"));
$sql_day1 = "SELECT * FROM `DM` WHERE DateMsg = '$today1' AND StatusMsg = 'none' ORDER BY `MailTitle` ASC";
$result_day1 = mysqli_query($conn, $sql_day1);

$today2 = date('Y-m-d', strtotime("+2 day"));
$sql_day2 = "SELECT * FROM `DM` WHERE DateMsg = '$today2' AND StatusMsg = 'none' ORDER BY `MailTitle` ASC";
$result_day2 = mysqli_query($conn, $sql_day2);

$today3 = date('Y-m-d', strtotime("+3 day"));
$sql_day3 = "SELECT * FROM `DM` WHERE DateMsg = '$today3' AND StatusMsg = 'none' ORDER BY `MailTitle` ASC";
$result_day3 = mysqli_query($conn, $sql_day3);

$today4 = date('Y-m-d', strtotime("+4 day"));
$sql_day4 = "SELECT * FROM `DM` WHERE DateMsg = '$today4' AND StatusMsg = 'none' ORDER BY `MailTitle` ASC";
$result_day4 = mysqli_query($conn, $sql_day4);

ob_end_clean();
require('../meta/fpdf184/fpdf.php');

class PDF extends FPDF
{

  function Header()
  {
  }
  function Footer()
  {

    // Go to 1.5 cm from bottom
    $this->SetY(-15);
    // Select Arial italic 8
    $this->SetFont('Helvetica', 'I', 8);
    // Print centered page number
    $this->Cell(0, 10, $GLOBALS['now'] . ' | ' . $GLOBALS['today_start'] . ' - ' . $GLOBALS['today_end'] . ' | Rukavina Group - Pregled tjedna | Stranica ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
  }
}
// Instantiate and use the FPDF class 
$pdf = new PDF();
$pdf->AliasNbPages();
// Page footer
//Add a new page
$pdf->AddPage();
$today_start = date('d.m.Y.');
$today_end = date('d.m.Y.', strtotime("+4 day"));
$now = date('h:i:s A');


$pdf->SetAuthor('Rukavina Group interni sustavi');
$pdf->SetTitle('Pregled Tjedna-' . $today_start . $today_end);
// Set the font for the text
$pdf->SetFont('Helvetica', '', 14);
// Prints a cell with given text 
$pdf->SetTextColor(194, 8, 8);
$pdf->SetFont('Helvetica', '', 19);
$pdf->Write(0, 'Rukavina Group Intranet | Pregled Tjedna');
$pdf->SetTextColor(51, 51, 51);
$pdf->Line(10, 15, 150 - 20, 15);
$pdf->SetFont('Helvetica', '', 12);
$pdf->Ln(9);
$pdf->Write(0, 'Razdoblje: ' . $today_start . ' - ' . $today_end);
$pdf->Ln(5);
$pdf->Write(0, 'Vrijeme PDF-a: ' . $now);
$pdf->Ln(5);
$pdf->Write(0, 'Stavki: ' . mysqli_num_rows($result_day) + mysqli_num_rows($result_day1) + mysqli_num_rows($result_day3) + mysqli_num_rows($result_day4));

$pdf->SetTextColor(51, 51, 51);
$pdf->Ln(5);

if (mysqli_num_rows($result_day) > 0) {
  while ($row_today = mysqli_fetch_array($result_day)) {
    $MailTitleRaw = $row_today['MailTitle'];
    $MailTitleChar = strtoupper($MailTitleRaw);
    $MailTextChar = $row_today['TextMsg'];
    $MailTitle = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $MailTitleChar);
    $MailText = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $MailTextChar);

    $MailTag = $row_today['MailTag'];
    $MailFile = $row_today['FileName'];
    $MailID = $row_today['MSGID'];
    $MailDate = $row_today['DateMsgHuman'];


    $pdf->SetFont('Helvetica', '', 12);
    $pdf->Cell(140, 7, $MailTitle, 'T', 1, 'L');
    $pdf->Ln(0);
    $pdf->SetFont('Helvetica', 'i', 6);
    $pdf->Write(0, 'Datum: ' . $MailDate);
    $pdf->Ln(3);
    $pdf->Write(0, 'ID: ' . $MailID);
    $pdf->Ln(3);

    if ($row_today['MailTag'] == '@rukavinagroup.com') {
    } else {
      $pdf->Write(0, 'Tag: ' . $MailTag);
      $pdf->Ln(3);
    }
    if ($row_today['FileName'] == 'null') {
    } else {
      $pdf->Write(0, 'File: ' . $MailFile);
      $pdf->Ln(3);
    }

    $pdf->SetFont('Helvetica', 'i', 9);
    $pdf->MultiCell(190, 5, $MailText, 0, 'L');
    $pdf->Ln(8);
  }
}
if (mysqli_num_rows($result_day1) > 0) {
  while ($row_today1 = mysqli_fetch_array($result_day1)) {
    $MailTitleRaw1 = $row_today1['MailTitle'];
    $MailTitleChar1 = strtoupper($MailTitleRaw1);
    $MailTextChar1 = $row_today1['TextMsg'];
    $MailTitle1 = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $MailTitleChar1);
    $MailText1 = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $MailTextChar1);

    $MailTag1 = $row_today1['MailTag'];
    $MailFile1 = $row_today1['FileName'];
    $MailID1 = $row_today1['MSGID'];
    $MailDate1 = $row_today1['DateMsgHuman'];


    $pdf->SetFont('Helvetica', '', 12);
    $pdf->Ln();
    //$pdf->Write(1,$MailTitle);
    $pdf->Cell(140, 7, $MailTitle1, 'T', 1, 'L');
    $pdf->Ln(0);
    $pdf->SetFont('Helvetica', 'i', 6);
    $pdf->Write(0, 'Datum: ' . $MailDate1);
    $pdf->Ln(3);
    $pdf->Write(0, 'ID: ' . $MailID1);
    $pdf->Ln(3);

    if ($row_today1['MailTag'] == '@rukavinagroup.com') {
    } else {
      $pdf->Write(0, 'Tag: ' . $MailTag1);
      $pdf->Ln(3);
    }
    if ($row_today1['FileName'] == 'null') {
    } else {
      $pdf->Write(0, 'File: ' . $MailFile1);
      $pdf->Ln(3);
    }

    $pdf->SetFont('Helvetica', 'i', 9);
    $pdf->MultiCell(190, 5, $MailText1, 0, 'L');
    $pdf->Ln(8);
  }
}
if (mysqli_num_rows($result_day2) > 0) {
  while ($row_today2 = mysqli_fetch_array($result_day2)) {
    $MailTitleRaw2 = $row_today2['MailTitle'];
    $MailTitleChar2 = strtoupper($MailTitleRaw2);
    $MailTextChar2 = $row_today2['TextMsg'];
    $MailTitle2 = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $MailTitleChar2);
    $MailText2 = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $MailTextChar2);

    $MailTag2 = $row_today2['MailTag'];
    $MailFile2 = $row_today2['FileName'];
    $MailID2 = $row_today2['MSGID'];
    $MailDate2 = $row_today2['DateMsgHuman'];


    $pdf->SetFont('Helvetica', '', 12);
    $pdf->Ln();
    //$pdf->Write(1,$MailTitle);
    $pdf->Cell(140, 7, $MailTitle2, 'T', 1, 'L');
    $pdf->Ln(0);
    $pdf->SetFont('Helvetica', 'i', 6);
    $pdf->Write(0, 'Datum: ' . $MailDate2);
    $pdf->Ln(3);
    $pdf->Write(0, 'ID: ' . $MailID2);
    $pdf->Ln(3);

    if ($row_today2['MailTag'] == '@rukavinagroup.com') {
    } else {
      $pdf->Write(0, 'Tag: ' . $MailTag2);
      $pdf->Ln(3);
    }
    if ($row_today2['FileName'] == 'null') {
    } else {
      $pdf->Write(0, 'File: ' . $MailFile2);
      $pdf->Ln(3);
    }

    $pdf->SetFont('Helvetica', 'i', 9);
    $pdf->MultiCell(190, 5, $MailText2, 0, 'L');
    $pdf->Ln(8);
  }
}
if (mysqli_num_rows($result_day3) > 0) {
  while ($row_today3 = mysqli_fetch_array($result_day3)) {
    $MailTitleRaw3 = $row_today3['MailTitle'];
    $MailTitleChar3 = strtoupper($MailTitleRaw3);
    $MailTextChar3 = $row_today3['TextMsg'];
    $MailTitle3 = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $MailTitleChar3);
    $MailText3 = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $MailTextChar3);

    $MailTag3 = $row_today3['MailTag'];
    $MailFile3 = $row_today3['FileName'];
    $MailID3 = $row_today3['MSGID'];
    $MailDate3 = $row_today3['DateMsgHuman'];


    $pdf->SetFont('Helvetica', '', 12);
    $pdf->Ln();
    //$pdf->Write(1,$MailTitle);
    $pdf->Cell(140, 7, $MailTitle3, 'T', 1, 'L');
    $pdf->Ln(0);
    $pdf->SetFont('Helvetica', 'i', 6);
    $pdf->Write(0, 'Datum: ' . $MailDate3);
    $pdf->Ln(3);
    $pdf->Write(0, 'ID: ' . $MailID3);
    $pdf->Ln(3);

    if ($row_today3['MailTag'] == '@rukavinagroup.com') {
    } else {
      $pdf->Write(0, 'Tag: ' . $MailTag3);
      $pdf->Ln(3);
    }
    if ($row_today3['FileName'] == 'null') {
    } else {
      $pdf->Write(0, 'File: ' . $MailFile3);
      $pdf->Ln(3);
    }

    $pdf->SetFont('Helvetica', 'i', 9);
    $pdf->MultiCell(190, 5, $MailText3, 0, 'L');
    $pdf->Ln(8);
  }
}
if (mysqli_num_rows($result_day4) > 0) {
  while ($row_today4 = mysqli_fetch_array($result_day4)) {
    $MailTitleRaw4 = $row_today4['MailTitle'];
    $MailTitleChar4 = strtoupper($MailTitleRaw4);
    $MailTextChar4 = $row_today4['TextMsg'];
    $MailTitle4 = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $MailTitleChar4);
    $MailText4 = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $MailTextChar4);

    $MailTag4 = $row_today4['MailTag'];
    $MailFile4 = $row_today4['FileName'];
    $MailID4 = $row_today4['MSGID'];
    $MailDate4 = $row_today4['DateMsgHuman'];


    $pdf->SetFont('Helvetica', '', 12);
    $pdf->Ln();
    //$pdf->Write(1,$MailTitle);
    $pdf->Cell(140, 7, $MailTitle4, 'T', 1, 'L');
    $pdf->Ln(0);
    $pdf->SetFont('Helvetica', 'i', 6);
    $pdf->Write(0, 'Datum: ' . $MailDate4);
    $pdf->Ln(3);
    $pdf->Write(0, 'ID: ' . $MailID4);
    $pdf->Ln(3);

    if ($row_today4['MailTag'] == '@rukavinagroup.com') {
    } else {
      $pdf->Write(0, 'Tag: ' . $MailTag4);
      $pdf->Ln(3);
    }
    if ($row_today2['FileName'] == 'null') {
    } else {
      $pdf->Write(0, 'File: ' . $MailFile4);
      $pdf->Ln(3);
    }

    $pdf->SetFont('Helvetica', 'i', 9);
    $pdf->MultiCell(190, 5, $MailText4, 0, 'L');
    $pdf->Ln(8);
  }
}

$now_id = md5(date('his'));


// return the generated output
//$pdf->Output($today_d .'_'. $now_id . '-rg-pregled_dana.pdf', 'I');
$filename = "tmp/" . $today_start . $today_end . '_' . $now_id . "_pregled_tjedna.pdf";
$pdf->Output($filename, 'F');


require_once('../meta/mail/src/PHPMailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$target = htmlspecialchars($_GET["target"]);

$email = new PHPMailer();
$email->AllowEmpty = true;
$email->SetFrom('intranet@rukavinagroup.com', 'Rukavina Group'); //Name is optional
$email->Subject   = '';
$email->Body      = '';
$email->AddAddress($target);

$file_to_attach = $filename;

$email->AddAttachment($file_to_attach, $filename);

$email->Send();
header("Location:  /?email_sent_to_" . $target . "&path=" . $filename);

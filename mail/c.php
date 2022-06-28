<?php
include_once '../meta/con1.rg.php';
session_start();

if (isset($_POST['CreateDM'])) {
    $mdf = md5(date("Y-m-d h:i:sa")).sha1(date("d-m-Y")).'-';
    $targetfolder = "tmp/" . $mdf;
    $targetfolder = $targetfolder . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder)) {
        $attachFile = 'Yes';
        $FileName = basename($_FILES['file']['name']);
    } else {
        $attachFile = 'No';
        $FileName = 'null';
    }
    $title = $_POST['MailTitle'];
    $text = $_POST['MailText'];
    $tag_post = $_POST['MailTag'];
    $Tag = $tag_post . '@rukavinagroup.com';
    $day = date('Y-m-d', strtotime("+1 day"));
    $dayH = date('d.m.Y.', strtotime("+1 day"));
    $now = date('d.m.Y. | h:i:sa');
    function generateRandomString($length = 4)
    {
        return substr(str_shuffle(str_repeat($x = '123456789', ceil($length / strlen($x)))), 1, $length);
    }
    function generateRandomString2($length = 4)
    {
        return substr(str_shuffle(str_repeat($x = '123456789', ceil($length / strlen($x)))), 1, $length);
    }
    date_default_timezone_set("Europe/Zagreb");
    $date = date("Ymd");
    $ID = generateRandomString();
    $ID2 = generateRandomString2();
    $MSGID = $date . '-' . $ID . '-' . $ID2;
    $query = "INSERT INTO `DM`(`DateMsg`,`DateMsgHuman`,`TextMsg`,`MSGID`, `MailTitle`, `StatusMsg`, `isImportant`, `MailSender`, `MailType`, `AttachFile`, `FileName`, `FileLink`, `MailTag`, `Deleted`, `Marked`, `Created`) VALUES ('$day','$dayH','$text','$MSGID', '$title', 'none', 'transparent', 'Intranet', 'Rucni unos', '$attachFile', '$FileName', '$mdf$FileName', '$Tag', 'No', 'No', '$now')";
    $query_run = mysqli_query($conn, $query);
    $to = $Tag;
    $subject = "Mail for $tag_post";
    $message = '<html><body>';
    $message .= "<h3> $title </h3>";
    $message .= "<p>$text</p>";
    $message .= "<br>";
    $message .= "<a href='https://00.intranet.rukavinagroup.com/mail/mail.php?MSGID=$MSGID&refferal=mail'>View online</a><br><br><a href='https://00.intranet.rukavinagroup.com/mail/pdfmail_open.php?MSGID=$MSGID&refferal=mail'>View as a PDF</a>";
    $message .= '</body></html>';
    $headers  = "From: Rukavina <intranet@rukavinagroup.com>\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    mail($to, $subject, $message, $headers);
    header("Location:  mail.php?MSGID=$MSGID");
}
if (isset($_POST['DelItem'])) {
    $now = date('d.m.Y. | h:i:sa');
    $item = $_POST['MSGID'];
    $query = "UPDATE DM SET StatusMsg = 'line-through' WHERE MSGID = '$item'";
    $query2 = "UPDATE DM SET isImportant = 'transparent' WHERE MSGID = '$item'";
    $query3 = "UPDATE DM SET AttachFile = 'No' WHERE MSGID = '$item'";
    $query4 = "UPDATE DM SET Deleted = '$now' WHERE MSGID = '$item'";
    $query_run = mysqli_query($conn, $query);
    $query_run2 = mysqli_query($conn, $query2);
    $query_run3 = mysqli_query($conn, $query3);
    $query_run4 = mysqli_query($conn, $query4);
    header("Location: /");
}
if (isset($_POST['RedItem'])) {
    $now = date('d.m.Y. | h:i:sa');
    $item = $_POST['MSGID'];
    $query = "UPDATE DM SET isImportant = '#ff000029' WHERE MSGID = '$item'";
    $query1 = "UPDATE DM SET Marked = '$now' WHERE MSGID = '$item'";
    $query_run = mysqli_query($conn, $query);
    $query_run1 = mysqli_query($conn, $query1);
    header("Location: mail.php?MSGID=" . $item);
}

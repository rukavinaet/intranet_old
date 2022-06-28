<?php
include_once '../meta/con1.rg.php';
session_start();

if (isset($_POST['CreateV'])) {
    date_default_timezone_set("Europe/Zagreb");
    $v = $_POST['Version'];
    $c = $_POST['CodeName'];
    $news = $_POST['Changes'];
    $YesNo = $_POST['YesNo'];
    $day = date('d.m.Y.');
    function generateRandomString($length = 19)
    {
        return substr(str_shuffle(str_repeat($x = '123456789', ceil($length / strlen($x)))), 1, $length);
    }
    $RICID = generateRandomString();
    $query = "INSERT INTO `IntranetChangelog`(`Version`,`CodeName`,`InstallDate`, `Changes`, `RICID`) VALUES ('$v','$c','$day', '$news', '$RICID')";
    $query_run = mysqli_query($conn, $query);
    if($YesNo == ('n')){
        header("Location:  index.php?changelog_not_sent");
    }
    else{
        $Tag = 'igm-noreply@intranet.rukavinagroup.com';
    $to = $Tag;
    $subject = "Intranet Update $v";
    $message = '<html><body>';
    $message .= "<h3>Intranet has just gained new and amazing features!<br>Check them out!</h3>";
    $message .= "<p>$news</p>";
    $message .= "<p>...and many more bug fixes and updates!</p>";
    $message .= "<br>";
    $message .= "<a href='https://00.intranet.rukavinagroup.com/?refferal=update_changelog_mail'>Visit Intranet $v</a>";
    $message .= '</body></html>';
    $headers  = "From: RGI <intranet@rukavinagroup.com>\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    mail($to,$subject,$message,$headers);
    }
    header("Location:  index.php?changelog_sent");
}
if (isset($_POST['SendIGN'])) {
    date_default_timezone_set("Europe/Zagreb");
    $t = $_POST['Title'];
    $text = $_POST['Text'];
    $who = $_POST['Sender'];
    $day = date('d.m.Y.');
    function generateRandomString($length = 20)
    {
        return substr(str_shuffle(str_repeat($x = '123456789', ceil($length / strlen($x)))), 1, $length);
    }
    //Intranet Global Notices Document ID
    $IGNDID = generateRandomString();
    $query = "INSERT INTO `IGN`(`IGNDID`, `DocTitle`, `DocText`, `DocSender`, `DocDate`) VALUES ('$IGNDID', '$t', '$text', '$who', '$day')";
    $query_run = mysqli_query($conn, $query);

    



    $Tag = 'igm-noreply@intranet.rukavinagroup.com';
    $to = $Tag;
    $subject = "$t";
    $message = '<html><body>';
    $message .= "<h3>$t</h3>";
    $message .= "<p>$text</p>";
    $message .= "<br>";
    $message .= "<hr>";
    $message .= "<br>";
    $message .= "<a href='https://00.intranet.rukavinagroup.com/administracija/ign/pregled.php?IGNDID=$IGNDID&refferal=mail'>View as a PDF</a>";
    $message .= "<br>";
    $message .= "<a href='https://00.intranet.rukavinagroup.com/index.php?reason=$IGNDID&refferal=mail'>Open Intranet</a>";
    $message .= "<br>";
    $message .= "<p style='opacity:50%;'>* Meta information are avaliable through Intranet pages.</p>";
    $message .= '</body></html>';
    $headers  = "From: RGI-GN <intranet@rukavinagroup.com>\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    mail($to,$subject,$message,$headers);
    header("Location:  index.php?ign_sent");
}
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
    $day = $_POST['Date'];
    $dayH = date("d.m.Y.", strtotime($day));  
    $Tag = $tag_post . '@rukavinagroup.com';
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
    $query = "INSERT INTO `DM`(`DateMsg`,`DateMsgHuman`,`TextMsg`,`MSGID`, `MailTitle`, `StatusMsg`, `isImportant`, `MailSender`, `MailType`, `AttachFile`, `FileName`, `FileLink`, `MailTag`, `Deleted`, `Marked`, `Created`) VALUES ('$day','$dayH','$text','$MSGID', '$title', 'none', 'transparent', 'Intranet Admin', 'Rucni unos', '$attachFile', '$FileName', '$mdf$FileName', '$Tag', 'No', 'No', '$now')";
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

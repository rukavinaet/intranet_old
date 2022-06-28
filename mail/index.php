<?php include_once '../meta/con1.rg.php';
$docsID = '';
if (isset($_GET['MSGID'])) {
    $ID_todo_view = mysqli_real_escape_string($conn, $_GET['MSGID']);
    $sql_todo_view = "SELECT * FROM DM WHERE MSGID='$ID_todo_view'";

    $result_todo_view = mysqli_query($conn, $sql_todo_view);
    $row_todo_view = mysqli_fetch_array($result_todo_view);
    if ($row_todo_view > 0) {
    } else {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../meta/head.php' ?>
<style>
    #dnevnimail {
        background-color: rgb(48, 48, 48);
    }
</style>
<script>
    function confirmDeletItem() {
        if (confirm("Izbriši predmet? Ova radnja je nepovratna!")) return true;
        return false;
    }

    function confirmRedItem() {
        if (confirm("Označi predmet? Ova radnja je nepovratna!")) return true;
        return false;
    }
</script>
<div class="body-c">
    <br>
    <p style="margin: 0px 20px;">Pregled mail-a: <?php echo $row_todo_view['MailTitle'] ?> (<?php echo $row_todo_view['DateMsgHuman'] ?>) <?php if ($row_todo_view['StatusMsg'] == 'none'){
        echo ("<span class='mobileshow'>| <a href='pdfmail_open.php?MSGID={$row_todo_view['MSGID']}'>PDF</a></span>");
    } ?></p>
    <hr style="margin: 0px 20px;">
    <br>
    <div class="body-con">
        <div class="dailmailshow">
            <style>
                .dailmailshow {
                    width: 100%;
                    height: 60vh;
                    border: 1px solid whitesmoke;
                    overflow-y: auto;

                }

                .dailmailshow p {
                    padding: 20px;
                }

                .datumi {
                    height: 50px;
                    display: flex;
                    align-items: center;
                    border-bottom: 1px solid whitesmoke;
                }

                .datumi p {
                    height: min-content;
                    padding-left: 20px;
                }

                .isFile {
                    border-top: 1px solid #f5f5f533;
                    width: max-content;
                }

                .isFile p {
                    padding: 5px 20px;
                    color: #f5f5f533;
                }
            </style>
            <div class="datumi" style="background-color: <?php echo $row_todo_view['isImportant'] ?>;">
                <p style="text-decoration:<?php echo $row_todo_view['StatusMsg'] ?>;"><?php echo $row_todo_view['MailTitle'] ?></p>
            </div>

            <p style="line-height:30px;text-decoration:<?php echo $row_todo_view['StatusMsg'] ?>;"><?php echo $row_todo_view['TextMsg'] ?></p>
            <?php
            if ($row_todo_view['AttachFile'] == 'Yes') {

                echo ("<div class='isFile'><p>Attached file:</p><p style='font-size:13px;'><a href='http://00.intranet.rukavinagroup.com/dm_file_uploads/{$row_todo_view['FileLink']}'>{$row_todo_view['FileName']}</a></p></div>");
            } else {
                echo ('');
            }
            ?>
            <form action="c.php" method="post" id="deleteitem" onsubmit="return confirmDeletItem()">

                <input type="text" hidden name="MSGID" value="<?php echo $row_todo_view['MSGID'] ?>">
            </form>
            <form action="c.php" method="post" id="reditem" onsubmit="return confirmRedItem()">
                <input type="text" hidden name="MSGID" value="<?php echo $row_todo_view['MSGID'] ?>">
            </form>


        </div>
    </div>
    <div class="app-controls">
        <script>
            function showcomments() {

            }
        </script>
        <ul>
            <?php
            if ($row_todo_view['StatusMsg'] == 'none') {
                if ($row_todo_view['isImportant'] == 'transparent') {
                    echo ("<li class='desktopshow'><a href='pdfmail_open.php?MSGID={$row_todo_view['MSGID']}'><button>Otvori PDF</button></a></li><li class='desktopshow'><a><button type='submit' form='deleteitem' name='DelItem' value='Submit'>Izbriši</button></a></li><li class='desktopshow'><a><button type='submit' form='reditem' name='RedItem' value='Submit'>Označi</button></a></li>");
                } else {
                    echo ("<li class='desktopshow'><a href='pdfmail_open.php?MSGID={$row_todo_view['MSGID']}'><button>Otvori PDF</button></a></li><li class='desktopshow'><a><button type='submit' form='deleteitem' name='DelItem' value='Submit'>Izbriši</button></a></li>");
                }
            } else {
                echo ('');
            }
            ?>
            <li><a><button onclick="metainfomail();">Meta</button></a></li>
            <li class="desktopshow"><a href="unos.php"><button>Novi unos</button></a></li>
            <li><a href="/"><button>Natrag</button></a></li>

        </ul>
    </div>
    <script>
        function metainfomail() {
            alert("Title: <?php echo $row_todo_view['MailTitle'] ?> \nMail-ID: <?php echo $row_todo_view['MSGID'] ?> \nSender: <?php echo $row_todo_view['MailSender'] ?> \nType: <?php echo $row_todo_view['MailType'] ?>\nFiles: <?php echo $row_todo_view['AttachFile'] ?>\nCreated: <?php echo $row_todo_view['Created'] ?>\nMarked: <?php echo $row_todo_view['Marked'] ?>\nDeleted: <?php echo $row_todo_view['Deleted'] ?>")
        }
    </script>
</div>
<?php include '../meta/h-f.php' ?>

</body>

</html>
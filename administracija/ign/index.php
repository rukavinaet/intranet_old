<?php include_once '../../meta/con1.rg.php'; ?>
<?php $docsID = ''; ?>
<?php
$sql_all_docs = "SELECT * FROM `IGN` ORDER BY `DocDate` DESC ";
$result_all_docs = mysqli_query($conn, $sql_all_docs);
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../../meta/head.php' ?>
<style>
    #administracija {
        background-color: rgb(48, 48, 48);
    }
</style>
<div class="body-c">
    <br>
    <p style="margin: 0px 20px;">Administracija > Intranet > Globalne Obavijesti</p>
    <hr style="margin: 0px 20px;">
    <br>
    <div class="body-con">
        <ul class="menu">
            <?php
            if (mysqli_num_rows($result_all_docs) > 0) {
                while ($row_all_docs = mysqli_fetch_array($result_all_docs)) {
                    echo "<li><a target='_blank' href='pregled.php?IGNDID={$row_all_docs['IGNDID']}'><button>{$row_all_docs['DocTitle']} | {$row_all_docs['DocDate']}</button></a></li>";
                }
            }
            ?>
        </ul>
    </div>
</div>
<?php include '../../meta/h-f.php' ?>

</body>

</html>
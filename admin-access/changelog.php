<?php include_once '../meta/con1.rg.php'; ?>
<?php session_start();
if (!isset($_SESSION["user"])) {
    header("Location: sigurnosni_link.php");
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">
<?php include '../meta/head.php' ?>
<style>
    #administracija {
        background-color: rgb(48, 48, 48);
    }
</style>
<div class="body-c">
    <br>
    <p style="margin: 0px 20px;">Administratorski pristup!</p>
    <hr style="margin: 0px 20px;">
    <br>
    <div class="body-con">
        <div class="noflex">
            <form action="c.php" method="post" id="newV">
                <input type="text" name="Version" placeholder="0.0.0" id=""><br><br>
                <input type="text" name="CodeName" placeholder="Vanessa" id=""><br><br>
                <hr><br><br>
                <textarea name="Changes" id="" cols="30" rows="10"><li>Added:</li>
<li>Fixed:</li></textarea>
                <br>
                <br>
                Poslati obavijest: <input type="text" name="YesNo" id="" placeholder=" y / n">
                <br>
                <br>
            </form>
        </div>
    </div>
    <div class="app-controls">
        <ul>
            <li><a href="index.php"><button>Odustani</button></a></li>
            <li><button type="submit" form="newV" name="CreateV">Poslati</button></li>
        </ul>
    </div>
</div>
<?php include '../meta/h-f.php' ?>
</body>

</html>
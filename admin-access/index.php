<?php session_start();
if (!isset($_SESSION["user"])) {
  header("Location: sigurnosni_link.php");
  exit();
} ?>
<?php include_once '../meta/con1.rg.php'; ?>
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
    <ul class="menu">
      <li>
        <a href="#"><button>Odobrenja</button></a>
      </li>
      <li>
        <a href="ign.php"><button>IGN</button></a>
      </li>
      <li>
        <a href="changelog.php"><button>Intranet ChangeLog</button></a>
      </li><li>
        <a href="dm.php"><button>Admin DM</button></a>
      </li>
    </ul>
  </div>
</div>
<?php include '../meta/h-f.php' ?>

</body>

</html>
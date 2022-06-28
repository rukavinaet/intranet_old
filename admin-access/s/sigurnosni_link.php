<?php include_once '../meta/con1.rg.php'; ?>
<?php require "2-check.php"; ?>
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
      <form id="login-form" method="post" target="_self">
        <h1>Potrebna je verifikacija korisnika:</h1><br><br>
        <label for="user">User</label><br>
        <input type="text" name="user" required /><br><br>
        <label for="password">Password</label><br>
        <input type="password" name="password" required /><br><br>
      </form>
    </div>
  </div>
  <div class="app-controls">
    <ul>
      <li><a><button type="submit" form="login-form">Prijava</button></a></li>
      <li><a href="https://00.intranet.rukavinagroup.com"><button>Natrag</button></a></li>
    </ul>
  </div>
</div>
<?php include '../meta/h-f.php' ?>

</body>

</html>
<?php session_start();
if (!isset($_SESSION["user"])) {
  header("Location: sigurnosni_link.php");
  exit();
} ?>
<?php include_once 'meta/con1.rg.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'meta/head.php' ?>
<style>
    #administracija {
        background-color: rgb(48, 48, 48);
    }
</style>
<div class="body-c">
    <br>
    <p style="margin: 0px 20px;">Unos novog mail-a ADMIN</p><!--STAVITI DA SE MOZE BIRATI DAN!!!!-->
    <hr style="margin: 0px 20px;">
    <br>
    <div class="body-con">
        <form enctype="multipart/form-data" action="c.php" method="post" id="formtest">
            <input type="date" name="Date" id="">
            <label for="MailTitle">Naslov mail-a: </label>
            <input maxlength="35" required type="text" name="MailTitle" id=""><br><br>
            <textarea placeholder="Ovaj element ne podržava HTML i ISO 8859-2 slova i oznake." required name="MailText" id="" cols="30" rows="10"></textarea><br><br>
            <label for="file">Dodatne datoteke (Max: ~1.1MB): </label>
            <input style="border: none;" type="file" name="file" id="file">
            <script>
                var uploadField = document.getElementById("file");

                uploadField.onchange = function() {
                    if (this.files[0].size > 1100000) {
                        alert("File is too big, maximum size is ~1.1MB. \nAlternatively, you can always send it by email.");
                        this.value = "";
                    };
                };
            </script>
            <br>
            <br>
            <hr>
            <br>
            <details>
                <summary>Tagiraj osobu?</summary>
                <br>
                <input style="border: none;border-bottom:1px solid whitesmoke;font-size:inherit;" type="text" name="MailTag" id="">@rukavinagroup.com
            </details>
            <br>
            <br>
            <br>
            <br>
            <p>Slanjem maila potvrđujem da ovaj mail u svom sadržaju ne sadrži vulgarnosti i neprimjere poruke i tekstove.</p>
        </form>
    </div>
    <div class="app-controls">
        <ul>
            <li><a href="/"><button>Odustani</button></a></li>
            <li><a><button type="submit" name="CreateDM" form="formtest" value="Pošalji">Pošalji</button></a></li>
        </ul>
    </div>
</div>
<?php include 'meta/h-f.php' ?>

</body>

</html>
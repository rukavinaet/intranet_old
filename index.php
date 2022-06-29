<?php include_once 'meta/con1.rg.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'meta/head.php' ?>
<style>
    #dnevnimail {
        background-color: rgb(48, 48, 48);
    }
</style>

<div class="desktop">
    <div class="body-c">
        <br>
        <p class="desktopshow" style="margin: 0px 20px;">Pregled tjedna:</p>
        <p class="mobileshow" style="margin: 0px 20px;">Pregled za danas i sutra:</p>
        <hr style="margin: 0px 20px;">
        <br>
        <div class="body-con">

        </div>
        <div class="app-controls">
            <ul>

                <script>
                    function emailprint() {
                        let target;
                        let mail = prompt("Enter a email adress:");
                        if (mail == null || mail == "") {
                            null;
                        } else {
                            target = mail;
                            window.location.href = "http://00.intranet.rukavinagroup.com/mail/pregled_tjedna.php?target="+mail;

                        }
                        
                    }
                </script>

                <li><a onclick="emailprint();" href="#"><button style="width: 70px;">Print</button></a></li>
                <li><a href="mail/unos.php"><button>Novi unos</button></a></li>

            </ul>
        </div>
    </div>
    <?php include 'meta/h-f.php' ?>

</div>


</body>

</html>
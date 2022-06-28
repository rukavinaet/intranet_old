<?php include_once '../meta/con1.rg.php'; ?>
<?php $docsID = ''; ?>
<!DOCTYPE html>
<html lang="en">
<?php include '../meta/head.php' ?>
<style>
    #administracija {
        background-color: rgb(48, 48, 48);
    }
</style>
<style>
    .a-ul {
        display: inline-block;
        list-style: none;
        width: 100%;
        border: 1px solid whitesmoke;
        margin: 0px 10px;
        height: 65vh;
        overflow: auto;
    }

    .a-ul p {
        margin: 10px;
        position: relative;
    }

    .a-ul button {
        width: 100%;
        border: 1px solid #ffffff47;
        background-color: transparent;
        height: 40px;
        font-size: initial;
    }

    .a-ul button:active {
        background-color: #ffffff47;

    }
</style>
<div class="body-c">
    <br>
    <p style="margin: 0px 20px;">Administracija</p>
    <hr style="margin: 0px 20px;">
    <br>
    <div class="body-con">
        <ul class="a-ul">
            <p>Intranet</p>
            <li>
                <a href="ign/">
                    <button>Globalne obavijesti</button>
                </a>
                <a href="ign/p/index.php">
                    <button>Prijedlozi</button>
                </a>
            </li>
        </ul>
        <ul class="a-ul">
            <p>Financije</p>
        </ul>
        <ul class="a-ul">
            <p>Web stranice & Servisi</p>
            <li>
                <a href="incidenti/">
                    <button>Incidenti</button>
                </a>
            </li>
        </ul>
        <ul class="a-ul">
            <p>Klijenti</p>
        </ul>
    </div>
</div>
<?php include '../meta/h-f.php' ?>

</body>

</html>
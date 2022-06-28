<?php include_once 'con1.rg.php'; ?>
<?php
$sql_version = "SELECT * FROM `IntranetChangelog` ORDER BY `IntranetChangelog`.`Version` DESC LIMIT 1";
$result_version = mysqli_query($conn, $sql_version);
$row_version = mysqli_fetch_array($result_version);
?>
<header>
    <div class="header-all">
        <div class="header-title-time">
            <h2 style="font-size:25px;border-left:4px solid red;padding-left:5px;">Rukavina Group Intranet</h2>
            <p><?php $today = date("l | F j, Y.");
                echo $today; ?></p>
        </div>
        <div class="header-menu">
            <ul>
                <li style="width: 190px;"><a style="width:190px;"id="dnevnimail" href="/">Dnevni mail / Kalendar</a></li>
                <li><a id="administracija" href="/administracija/">Administracija</a></li>
                <li><a id="doc" href="/dokumenti/">Dokumenti</a></li>
                <li><a id="test" href="/testiranja/">Testiranja</a></li>
            </ul>
        </div>
    </div>
</header>
<footer>
    <div id="f-info" onclick="changelog();">
    </div>
    <div id="f-info-display" onclick="null();">
        <div class="f-info-display-content">
            <div class="f-info-display-content-left">
                <h1 style="color:black;">Verzija <?php echo $row_version['Version'] ?></h1>
                <h2 style="color:black;">Kodno ime: <?php echo $row_version['CodeName'] ?></h2>
                <p style="color:black;line-height:30px;">Datum instalacije: <?php echo $row_version['InstallDate'] ?></p>
                <!--RICID = Rukavina Intraned Changelog ID-->
                <p style="color:black;">RICID: <?php echo $row_version['RICID'] ?></p>
            </div>
            <div class="f-info-display-content-right">
                <ul>
                    <?php echo $row_version['Changes'] ?>
                </ul>
            </div>
        </div>
    </div>
    <script>
        function changelog() {
            if (document.getElementById("f-info").style.display == "block") {
                document.getElementById("f-info").style.display = "none";
                document.getElementById("f-info-display").style.display = "none";
            } else {
                document.getElementById("f-info").style.display = "block";
                document.getElementById("f-info-display").style.display = "block";
            }
        }
    </script>
    <div class="footer-all">
        <p style="font-size: 12px;padding-inline:10px;">RGI is a part of Rukavina Group and it is closed-source software.</p>
        <ul>
            <li><a style="cursor: pointer;" href="/docs/<?php echo $GLOBALS['docsID']?>">RGI Docs</a></li>
            <li><a style="cursor: pointer;" onclick="changelog();">Intranet <?php echo $row_version['Version'] ?></a></li>
            <li><a target="_blank" href="/meta/info.php">PHP INFO</a></li>
            <li><a href="/admin-access/">ADMIN</a></li>
        </ul>
    </div>
</footer>
<style>
    header {
        height: 100px;
        width: 100%;
        display: block;
        position: fixed;
        top: 0px;
        background-color: rgb(41, 41, 41);

    }

    .header-title-time {
        margin: 0px 10px;
        width: inherit;
        height: 50px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: initial;
    }

    .header-menu {
        height: 50px;
        border-top: 1px solid rgba(245, 245, 245, 0.226);
        display: block;


    }

    .header-menu ul {
        height: inherit;
    }

    .header-menu ul li {
        display: inline-flex;
        height: 50px;
        width: 150px;
        text-align: center;
    }

    .header-menu ul li a {
        height: 50px;
        width: 150px;
        display: flex;
        align-items: center;
        padding-left: 10px;
        text-decoration: none;
        text-align: start;
    }

    .mobile {
        display: none;
    }

    .desktop {
        display: initial;
    }

    footer {
        position: fixed;
        background-color: rgb(41, 41, 41);

    }

    .footer-all {
        height: 20px;
        width: 100%;
        position: fixed;
        border-top: 1px solid rgba(245, 245, 245, 0.226);
        background-color: rgb(41, 41, 41);

        height: inherit;
        display: flex;
        bottom: 0px;
        justify-content: space-between;
        align-items: center;


    }

    .footer-all ul {
        display: flex;
    }

    .footer-all ul li {
        display: flex;
        padding-inline: 10px;
    }


    .footer-all ul li a {
        text-decoration: none;
        font-size: 12px;
    }

    #f-info {
        width: 100%;
        height: 60%;
        display: none;
        position: fixed;
        background-color: #0000002e;
        top: 0px;
    }

    #f-info-display {
        display: none;
        position: fixed;
        height: 40%;
        bottom: 13px;
        width: 100%;
        right: 0px;
        background-color: aliceblue;
    }

    .f-info-display-content {
        margin: 20px;
        height: 100%;
        display: flex;
        justify-content: space-evenly;
    }

    .f-info-display-content-right {
        margin-top: 10px;
        overflow: auto;
        margin-bottom: 10px;
        width: max-content;
        height: 89%;
    }

    .f-info-display-content-right ul li {
        color: black;
    }

    @media all and (max-width: 900px) {
        footer {
            display: none;
        }

        header {
            height: 50px;
        }

        .header-title-time {
            margin: 0px 10px;
            width: inherit;
            height: 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;

        }

        .header-title-time p {
            display: none;
        }

        .header-menu {
            display: none;


        }
    }
</style>
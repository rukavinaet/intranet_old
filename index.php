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

            <div class="dailmailshow">
                <style>
                    .dailmailshow {
                        width: 100%;
                        height: 60vh;
                        border: 1px solid whitesmoke;

                    }

                    .dailmailshow ul {
                        display: flex;
                        justify-content: space-evenly;
                    }

                    .dailmailshow ul li {
                        display: inline-block;
                        width: 100%;
                        height: calc(60vh - 50px);
                        overflow-y: auto;
                        opacity: 50%;
                    }

                    .dailmailshow ul li:first-child {
                        opacity: 100%;
                    }

                    .dailmailshow ul li a button {
                        width: 100%;
                        height: 50px;
                        background-color: transparent;
                        border: 1px solid rgba(245, 245, 245, 0.226);
                        cursor: pointer;
                        font-size: initial;

                    }

                    .dailmailshow ul li a button:hover {
                        background-color: rgba(245, 245, 245, 0.1);
                    }

                    .dailmailshow ul li p {
                        width: 100%;
                        height: 50px;
                        position: fixed;
                    }

                    .datumi {
                        width: 100%;
                        display: flex;
                        justify-self: space-evenly;
                    }

                    .datumi ul {
                        display: flex;
                        justify-content: space-between;
                        width: 100%;
                        align-items: center;
                        border-bottom: 1px solid whitesmoke;
                    }

                    .datumi ul li {
                        height: 50px;
                        display: flex;
                        justify-content: space-around;
                        align-items: center;
                        opacity: 50%;
                    }

                    .datumi ul li:first-child {
                        opacity: 100%;
                    }

                    .datumi ul li p {
                        height: min-content;
                        width: max-content;
                        position: absolute;
                    }
                </style>
                <div class="datumi">
                    <ul>
                        <li>
                            <p><?php echo date("l"); ?> | <?php echo date("d.m."); ?></p>
                        </li>
                        <li style="border-right: 1px dashed #f5f5f52e;">
                            <p><?php echo date("l", strtotime("+1 day")); ?> | <?php echo date("d.m.", strtotime("+1 day")); ?></p>
                        </li>
                        <li class="desktopshow">
                            <p><?php echo date("l", strtotime("+2 day")); ?> | <?php echo date("d.m.", strtotime("+2 day")); ?></p>
                        </li>
                        <li class="desktopshow">
                            <p><?php echo date("l", strtotime("+3 day")); ?> | <?php echo date("d.m.", strtotime("+3 day")); ?></p>
                        </li>
                        <li class="desktopshow">
                            <p><?php echo date("l", strtotime("+4 day")); ?> | <?php echo date("d.m.", strtotime("+4 day")); ?></p>
                        </li>

                    </ul>
                </div>
                <ul>
                    <li>
                        <?php
                        if (mysqli_num_rows($result_dm_index_today) > 0) {
                            while ($row_dm_index_today = mysqli_fetch_array($result_dm_index_today)) {
                                echo "<a href='mail/?MSGID={$row_dm_index_today['MSGID']}'><button style='text-decoration:{$row_dm_index_today['StatusMsg']};line-break:anywhere;background-color:{$row_dm_index_today['isImportant']};'>{$row_dm_index_today['MailTitle']}</button></a>";
                            }
                        }
                        ?>

                    </li>
                    <li style="border-right:1px dashed #f5f5f52e;">
                        <?php
                        if (mysqli_num_rows($result_dm_index_tomorow) > 0) {
                            while ($row_dm_index_tomorow = mysqli_fetch_array($result_dm_index_tomorow)) {
                                echo "<a href='mail/?MSGID={$row_dm_index_tomorow['MSGID']}'><button style='text-decoration:{$row_dm_index_tomorow['StatusMsg']};line-break:anywhere;background-color:{$row_dm_index_tomorow['isImportant']};'>{$row_dm_index_tomorow['MailTitle']}</button></a>";
                            }
                        }
                        ?>
                    </li>
                    <li class="desktopshow">
                        <?php
                        if (mysqli_num_rows($result_dm_index_2) > 0) {
                            while ($row_dm_index_2 = mysqli_fetch_array($result_dm_index_2)) {
                                echo "<a href='mail/?MSGID={$row_dm_index_2['MSGID']}'><button style='text-decoration:{$row_dm_index_2['StatusMsg']};background-color:{$row_dm_index_2['isImportant']};'>{$row_dm_index_2['MailTitle']}</button></a>";
                            }
                        }
                        ?>
                    </li>
                    <li class="desktopshow">
                        <?php
                        if (mysqli_num_rows($result_dm_index_3) > 0) {
                            while ($row_dm_index_3 = mysqli_fetch_array($result_dm_index_3)) {
                                echo "<a href='mail/?MSGID={$row_dm_index_3['MSGID']}'><button style='text-decoration:{$row_dm_index_3['StatusMsg']};background-color:{$row_dm_index_3['isImportant']};'>{$row_dm_index_3['MailTitle']}</button></a>";
                            }
                        }
                        ?>
                    </li>
                    <li class="desktopshow">
                        <?php
                        if (mysqli_num_rows($result_dm_index_4) > 0) {
                            while ($row_dm_index_4 = mysqli_fetch_array($result_dm_index_4)) {
                                echo "<a href='mail/?MSGID={$row_dm_index_4['MSGID']}'><button style='text-decoration:{$row_dm_index_4['StatusMsg']};background-color:{$row_dm_index_4['isImportant']};'>{$row_dm_index_4['MailTitle']}</button></a>";
                            }
                        }
                        ?>
                    </li>


                </ul>
            </div>
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
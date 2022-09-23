<?php
include "core/conn.php";
include "core/header.php";
include "core/nav.php";
//include "core/logged_in.php";
$ban_data = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM bans WHERE userid='". $_USER['id'] ."' AND unbanned='0'"));
$extra_message = "";
if ($ban_data['bantype'] == 'reminder') {
  $ban_type = 'Reminder';
} else if ($ban_data['bantype'] == 'warning') {
  $ban_type = 'Warning';
} else if ($ban_data['bantype'] == '1dayban') {
  $ban_type = 'Banned for 1 Day';
  $extra_message = "<p>
    Your account has been disabled for 1 day.
  </p>";
} else if ($ban_data['bantype'] == '3dayban') {
  $ban_type = 'Banned for 3 Days';
  $extra_message = "<p>
    Your account has been disabled for 3 days.
  </p>";
} else if ($ban_data['bantype'] == '7dayban') {
  $ban_type = 'Banned for 1 Week';
  $extra_message = "<p>
    Your account has been disabled for 7 days.
  </p>";
} else if ($ban_data['bantype'] == '14dayban') {
  $ban_type = 'Banned for 2 Weeks';
  $extra_message = "<p>
    Your account has been disabled for 14 days.
  </p>";
} else if ($ban_data['bantype'] == 'deleteaccount') {
  $ban_type = 'Account Deleted';
  $extra_message = "<p>
    Your account has been terminated.
  </p>";
} else {
  $ban_type = $ban_data['bantype'];
}


?>
<?php //echo $alert ?>
<style>
  body {
    font: normal 8pt/normal 'Comic Sans MS' , Verdana, sans-serif;
  }
</style>
<title>NovaBricks - Banned</title>
<div id="Body">
<div style="margin: 100px auto 100px auto; width: 500px; border: black thin solid; padding: 22px; color: black;">
  <h2 style="text-align:center;"><?php echo $ban_type ?></h2>
  <p>
    Our content monitors have determined that your behaviour at <?=$sitename?> has been in violation of our Terms of Service. We will terminate your account if you do not abide by the rules.
  </p>
<p>Reviewed: <span style="font-weight: bold"><?php echo $ban_data['created'] ?></span></p>
  <p>
    Moderator note: </span><span style="font-weight: bold"><?php echo $ban_data['reason'] ?></span></p>
  </p>
  <p>
    Please abide by the <?=$sitename?> Community Guidelines so that <?=$sitename?> can be fun for users of all ages.
  </p>

  <?php
  echo $extra_message;
  ?>

  <p>
    <a href='/Login/Expire.php'>Log out</a>
    <?php
    if (($ban_data['unbantime'] <= time()) && ($ban_data['bantype'] != 'deleteaccount')) {
      echo " | <a href='/reactivate_account.php'>Reactivate account</a>";
    }
    ?>
  </p>
</div>
</body>
<?php
include "core/footer.php";
?>
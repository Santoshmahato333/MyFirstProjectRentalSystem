<?php
 session_start();
 include "../config/config.php";
 if (!isset($_SESSION['loggedin'])) {
    echo "<script>alert('You need to login first to send email!'); window.history.back();</script>";
    die;    
 }

 $s = $_GET['s'];
 $sr = $_GET['sr'];
 $r = $_GET['r'];
 $rr = $_GET['rr'];
 $sql = "
 SELECT sr.email,sr.full_name as name from $sr as sr where sr.".$sr."_id = $s
 UNION ALL
 SELECT rr.email, rr.full_name as name from $rr as rr where rr.".$rr."_id = $r
 ";

 echo "<pre>";
//   echo $sql; 
// die;
 $emails = mysqli_query($db, $sql);
 if ($emails->num_rows == 2) {
 $sender = $emails->fetch_assoc();
 $s = $sender['email'];
 $sn = $sender['name'];
 print_r($sender);
 $receiver = $emails->fetch_assoc();
 $r = $receiver['email'];
 $rn = $receiver['name'];
 print_r($receiver);
  
?>
	<h2 style="text-align: center;">Email: <?=$sn?> (<?=$sr?>) -> <?=$rn?> (<?=$rr?>)</h2><hr><br>

<div style="background-color: lightgray; margin: auto; width: max-content; padding: 15px; border-radius: 10px;">
<form action="mailer.php?s=<?=urlencode($s)?>&r=<?=urlencode($r)?>&sr=<?=urlencode($sr)?>&rr=<?=$rr?>&sn=<?=$sn?>&rn=<?=$rn?>" method="POST" enctype="multipart/form-data">
		<input type="text" name="et"  value="<?=$et?>" style="display: none;">
		<input type="text" name="eid"  value="<?=$eid?>" style="display: none;">
		<input type="email" name="email-from" id="email-from" placeholder="Your Email" value="<?=$s?>" style="display: none;">
		<input type="email-to" name="email-to" id="email-to" placeholder="<?=$_GET['r']?>" value="<?=$r?>" style="display: none;" disabled>
		<label for="subject">Subject : </label><br>
		<input type="text" name="subject" id="subject"><br><br>
		<label for="message">Message : </label><br>
		<textarea rows="10" cols="100" name="message" id="message"></textarea><br><br>
		<label for="documents">Required Documents : </label>
		<input type="file" name="documents[]" multiple><br><br>
		<button>Send Email</button>
	</form>
</div>
<?php
} else {
	echo "<i>Invalid URL</i>!";
}
?>
<?php
	 session_start();
	$s = $_GET['s'];
	$r = $_GET['r'];
	$sr= $_GET['sr'];
    $rr= $_GET['rr'];
    $sn= $_GET['sn'];
    $rn= $_GET['rn'];

    // echo "<pre>";
    // print_r($_GET);
    // echo $s, $r, $sr, $rr, $sn, $rn;
    // echo "</pre>";

    // die;

	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
	require 'vendor/autoload.php';

	//Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
		 //Server settings
		 $mail->isSMTP();                                            //Send using SMTP
		 $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		 $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		 $mail->Username   = 'santoshmahato2481832@gmail.com';                     //SMTP username
		 $mail->Password   = 'udse oyhy vvvd vnie';                               //SMTP password
		 $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		 $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		 //Recipients
		 $mail->addAddress(urldecode($_GET['r']));  
         if (isset($_FILES['documents']))    {         //Name is optional
         foreach($_FILES['documents']['name'] as $key => $value){
            $filename = uniqid().$_FILES['documents']['name'][$key];
            if (move_uploaded_file($_FILES['documents']['tmp_name'][$key], 'uploads/'.$filename)) {
                 $mail->addAttachment('uploads/'.$filename, $_FILES['documents']['name'][$key]);

            }
           
            
		 }
         }
		 //Content
		 $mail->isHTML(true);                                  //Set email format to HTML
		 $mail->Subject = (isset($_POST['subject'])) ? $_POST['subject'] :  "Property Booked";
         $message =  "By : $sn (Tenant)\n Email : $s\n Please visit your Owner Profile to see more details! Or contact the Teanant via email we have provided you with!\n\n Thank you for using RentHouse! \n\n We are Happy to be at your service!";
		 $mail->Body    = "From: " . $sn . "(".$sr.")<br>To : You (". $rr .")<br>Email: ".$s."<br><br> ". ((isset($_POST['message'])) ?  $_POST['message'] :  "<br> Please visit your Owner Profile to see more details! Or contact the Teanant via email we have provided you with!<br><br> Thank you for using RentHouse! <br> We are Happy to be at your service!");
		 $mail->AltBody = (isset($_POST['message'])) ? $_POST['message'] : $message;

		 $mail->send();
        echo "<script>
        alert('Email Sent Successfully!');  
		window.history.back();
	</script>";
	} catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

        echo "<script>alert('Failed to Send Email! Some Error Occurred!')</script>";
	}
		 /* header("Location: ./email.php"); */
?>
	
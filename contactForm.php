<!DOCTYPE html>
<html>
<head>
	<title>Contact Us</title>
	<meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">


	  <link rel="stylesheet" href="style2.css">
	  
	  <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

	 
</head>
<body>
	<div class="container">
		
		<div class="row">
			<div class="col-sm-offset-1 col-sm-10 contactForm">
				<h1>Contact Us</h1>

<?php 

if(isset($_POST['name']))
	$name = $_POST['name'];

if(isset($_POST['email']))
	$email = $_POST['email'];

if(isset($_POST['message']))
	$message = $_POST['message'];


$errors='';

$missingName = '<p><strong>Please Enter Your Name</strong></p>';
$missingEmail = '<p><strong>Please Enter Your Email Address</strong></p>';
$invalidEmail = '<p><strong>Please Enter Your correct Email Address</strong></p>';
$missingMessage = '<p><strong>Please Enter a Message</strong></p>';


if(isset($_POST['submit'])){
	if(!$name){
		$errors.=$missingName;
	}else{
		$name = filter_var($name,FILTER_SANITIZE_STRING);
	}

	if(!$email){
		$errors.=$missingEmail;
	}else{
		$email = filter_var($email,FILTER_SANITIZE_EMAIL);
		if(!filter_var($email,FILTER_VALIDATE_EMAIL))
			$errors.=$invalidEmail;


	}
	if(!$message){
        $errors .= $missingMessage;
    }else{
        $message = filter_var($message, FILTER_SANITIZE_STRING);   
    }

	if($errors){
		$resultMessage = '<div class="alert alert-danger">' . $errors . '</div>';

		echo $resultMessage;

	}else{
		require 'PHPMailer/src/PHPMailer.php';
			require 'PHPMailer/src/Exception.php';
			require 'PHPMailer/src/SMTP.php';

			$mail = new PHPMailer\PHPMailer\PHPMailer();

			$mail->isSMTP();                            // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                     // Enable SMTP authentication
			$mail->Username = '/*your mail*/'       // SMTP username
			$mail->Password = '/*mail password*/'; // SMTP password
			$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                          // TCP port to connect to

			$mail->setFrom('gouravsrkian@gmail.com', 'Gourav_the_developer');
			$mail->addReplyTo('gouravsrkian@gmail.com', 'Gourav_the_developer');
			$mail->addAddress('gouravsrkian@gmail.com');   // Add a recipient
			

			$mail->isHTML(true);  // Set email format to HTML

			$bodyContent = '<h3>' . $email . '</h3>' ;
			$bodyContent .= '<p>'. $message . '</p>';

			$mail->Subject = 'Email from Localhost by Client';
			$mail->Body    = $bodyContent;

			if(!$mail->send()) {
				echo '<div class="alert alert-danger">Message could not be sent '. $mail->ErrorInfo . '</div>';
			    // echo 'Message could not be sent.';
			    // echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo '<div class="alert alert-success">Message has been sent</div>';
			    // echo 'Message has been sent';
			}
				}




}





?>


				<form action="contactForm.php" method="post">

					<div class="form-group">
					    <label>Name</label>
					    <input type="text" name = "name" class="form-control" value="<?php 
					    	if(isset($_POST['name']))
					    		echo $_POST['name']

					    ; ?>" placeholder="Enter Your Name">
				   
				  	</div>


					<div class="form-group">
					    <label for="exampleInputEmail1">Email address</label>
					    <input type="email" name="email" class="form-control" value="<?php 
					    	if(isset($_POST['email']))
					    		echo $_POST['email']

					    ; ?>" placeholder="Enter email">
					    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
				  </div>

				  <div class="form-group">
					    <label>Message</label>
					    <textarea  class="form-control" name="message" id="meassage" rows="5">
					    	<?php 
					    	if(isset($_POST['message']))
					    		echo $_POST['message']

					    ; ?>
					    	
					    </textarea>  
				   
				  	</div>
				  
				  
				  <button type="submit" name="submit" class="btn btn-lg btn-primary">Send Message</button>
				</form>	


			</div>
		</div>

	</div>


</body>
</html>

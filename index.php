<?php 

$SITE_URL = "http://localhost:8080/emberlink/";


// Plans

$plans = array(
	array("Small", "5", "3", "$20", "Description Lorem dolor sit amet, consectetur adipisicing elit. Ullam ducimus perferendis quaerat quidem."),
	array("Medium", "10", "5", "$40", "Description Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam ducimus perferendis id minus quaerat quidem vitae."),
	array("Large", "20", "10", "$60", "Descriptionipsum dolor sit amet, consectetur adipisicing elit. Ducimus perferendis id quaerat quidem vitae.")
);


// Plans on mobile if we keep this design?  Two contact things, one for general and one if they "Select this plan";



// Contact Form

function test($data) { // Prevent attacks 

	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;

}

if ($_GET['action'] == "email") {

	if (!$_POST['name']) {

		echo "2";
		exit();

	} else if (!$_POST['email']) {

		echo "3";
		exit();

	} else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {

		echo "4";
		exit();

	} else if (!$_POST['comments']) {

		echo "5";
		exit();

	}

	$name = test($_POST["name"]);
	$email = test($_POST["email"]);
	$comments = test($_POST["comments"]);

	//Prepare email

	$toEmail = "jscharbusiness@gmail.com, ".$email;
	$subject = "Contact Request From ". $name;
	$body = "<h2>Contact Request</h2>
			<h4>Name: </h4><p>".$name."</p>
			<h4>Email: </h4><p>".$email."</p>
			<h4>Message: </h4><p>".$comments."</p>";

	$headers = "MIME-Version: 1.0" ."\r\n";
	$headers .="Content-Type:text/html;charset=UTF-8". "\r\n";
	$headers .= "From: " .$name. "<".$email.">". "\r\n";

	if (mail($toEmail, $subject, $body, $headers)) {

		echo "1";
		exit();

	}

}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Emberlink</title>

	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

	<link rel="stylesheet" href="css/main.css">
	<!-- fonts?  google analytics -->

</head>
<body>

	<!-- Navigation -->
	<nav>
		<a id="logo" href="<?php echo $SITE_URL; ?>"><img src="images/logo.png" alt="Emberlink Logo"></a>
		<ul>
			<li><a href="#plans">Plans</a></li>
			<li><a href="#coverage">Coverage</a></li>
			<li><a href="#about">About</a></li>
			<li><a href="#contact">Contact</a></li>
		</ul>
	</nav>
	<main>

		<!-- Pricing -->
		
		<div class="section" id="plans">
			<h1>Plans</h1>
			<div id="displayInfo"><?php 

				$plan = $plans[0];
				$name = $plan[0];
				$download = $plan[1];
				$upload = $plan[2];
				$cost = $plan[3];
				$description = $plan[4];
				$id = "0";

				echo '
					<div class="name">'.$name.'</div>
					<div class="cost">'.$cost.'</div>
					<div class="download"><span class="number">'.$download.'</span>mbps&darr;</div>
					<div class="upload"><span class="number">'.$upload.'</span>mbps&uarr;</div>
					<div class="description">'.$description.'</div>
					<div class="select"><a data-id="'.$id.'">I want this!</a></div>';


			 ?></div>
			<div id="options">
				<?php

					$i = 0;
					$lastElement = end($plans);
					foreach ($plans as $arrayNumber => $plan) {

						$name = $plan[0];
						$download = $plan[1];
						$upload = $plan[2];
						$cost = $plan[3];
						$description = $plan[4];
						$id = $i;

						if ($i == 0) {
							$active = "active";
						} else {
							$active = "";
						}

						echo '<div class="plan '.$active.'">

							<div class="name">'.$name.'</div>
							<div class="cost">'.$cost.'</div>
							<div class="speed"><span class="number">'.$download.'</span>mbps&darr;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="number">'.$upload.'</span>mbps&uarr;</div>
							<div class="download"><span class="number">'.$download.'</span>mbps&darr;</div>
							<div class="upload"><span class="number">'.$upload.'</span>mbps&uarr;</div>
							<div class="description">'.$description.'</div>
							<div class="select"><a data-id="'.$id.'">I want this!</a></div>

						</div>';

						$i++;
					}

				?>
			</div>
		</div>

		<!-- Coverage Map -->
		
		<div class="section" id="coverage">
			<h1>Coverage Map</h1>
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d80942.99666160284!2d-81.81111175381218!3d40.99159395270625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1532357942099" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			<button>Check</button>
			<button>New Site</button>
		</div>

		<!-- About Us -->
		
		<div class="section" id="about">
			<h1>About Us</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum cumque nulla dolore, alias ducimus? At placeat laborum tempora magni vel eum, mollitia hic dignissimos non omnis? Odit id, quaerat repellat.</p>
		</div>
	 
		<!-- Contact -->

		<div class="section" id="contact">
			<h1>Contact Us</h1>

			<?php 
				echo "
				<div id='form'>
					<div id='error'></div>
					<div id='success'></div>
					<label>* Name: </label><input type=\"text\" class='formInput' id='name' name=\"name\" value=\"\"/>
					<label>* Email: </label><input type=\"email\" class='formInput' id='email' name=\"email\" value=\"\"/>
					<label>* Comments: </label><textarea class='formTextarea' id='comments' name=\"comments\" rows=\"5\" cols=\"15\"></textarea>
					<div class='formSubmit'><div class=\"submit\" id=\"submit\" name=\"submit\">Send!</div></div>
				</div>";
			?>
		</div>
	</main>

	<footer>
		<ul>
			<li><a href="#plans">Plans</a></li>
			<li><a href="#coverage">Coverage</a></li>
			<li><a href="#about">About</a></li>
			<li><a href="#contact">Contact</a></li>
		</ul>
	</footer>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
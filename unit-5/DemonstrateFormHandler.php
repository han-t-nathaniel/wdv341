<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Check the honeypot field.
	if (!empty($_POST["phoneNumber"])) {
		die("Invalid Access");
	}

	// Get form input.
	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$email = $_POST["email"];
	$academicStanding = $_POST["academicStanding"];
	$selectedMajor = $_POST["selectedMajor"];
	$comments = $_POST["comments"];

	// Find out which checkboxes were selected.
	$sendProgramInfo = isset($_POST["sendProgramInfo"]) ? true : false;
	$contactAdvisor = isset($_POST["contactAdvisor"]) ? true : false;

	$programAcronyms = [
		"cis" => "Computer Information Systems",
		"grd" => "Graphic Design",
		"wdv" => "Web Development"
	];

	$programPhrase = $programAcronyms[$selectedMajor];

	$confirmationMessage = 
		"<p>Dear $firstName $lastName,</p>
		<p>Thank you for your interest in DMACC.</p>
		<p>We have you listed as a $academicStanding starting this fall.</p>
		<p>You have declared $programPhrase as your major.</p>
		<p>Based on your responses we will provide the following information in our confirmation email to you at <em>$email</em>.</p>
		<p><input type=\"checkbox\" id=\"sendProgramInfo\" disabled"; 
		
	if ($sendProgramInfo) {
		$confirmationMessage .= " checked";
	}

	$confirmationMessage .=
		"/>
		<label for=\"contactAdvisor\">Please contact me with program information</label><br/>
		<input type=\"checkbox\" id=\"contactAdvisor\" disabled"; 
		
		if ($contactAdvisor) {
			$confirmationMessage .= " checked";
		}
	
		$confirmationMessage .=
			"/>
			<label for=\"contactAdvisor\">I would like to contact a program advisor</label></p>
			<p>You have shared the following comments which we will review:</p>
			<blockquote><em>$comments<em></blockquote>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!--
      Author: Nathaniel Han
      Date: February 2 2023
  -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WDV 341 5-1: HTML Form Processor | Confirmation Page</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost&family=Libre+Baskerville:wght@400;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="/css/bubbles.css">
</head>

<body>
  <div class="body-bg"></div>
  <nav>
    <div class="site-logo">
      <a href="/">
        <object type="image/svg+xml" data="/img/ngh-logo-white.svg"></object>
      </a>
    </div>
    <div class="nav-links">
      <a href="/">&lt; Back to Home</a>
    </div>
  </nav>
  <main>
    <h1>WDV 341 | 5-1: HTML Form Processor</h1>
	<h2>Confirmation Page</h2>
    <p>
		<?= $confirmationMessage ?>
	</p>
  </main>
</body>

</html>
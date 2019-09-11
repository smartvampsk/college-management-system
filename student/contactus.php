<?php 
	session_start();
	if (!isset($_SESSION['stdId'])) {
		header('location:../frontend/login.php');
	}
	$title = "WUC - Contact us";
	require 'header.php';
?>
<?php 
	if (isset($_POST['submit'])) {
		$enquiry = $pdo->prepare("INSERT INTO enquires(firstname, surname, email, telephone, enquiry)
			VALUES(:firstname, :surname, :email, :telephone, :enquiry)");
		$criteria = [
			'firstname' => $_POST['firstname'],
			'email' => $_POST['email'],
			'surname' => $_POST['surname'],
			'telephone' => $_POST['phone'],
			'enquiry' => $_POST['enquiry']
		];
		$enquiry->execute($criteria);
	}
?>

<section class="contact-section">
	<div class="contact-form">
		<form method="post" action="">
			<h3>Contact us</h3>
			<label>Firstname:</label><input type="text" name="firstname"><br><br>
			<label>Surname:</label><input type="text" name="surname"><br><br>
			<label>Telephone:</label><input type="text" name="phone"><br><br>
			<label>Email:</label><input type="email" name="email"><br><br>
			<label>Enquiry:</label><textarea name="enquiry" placeholder="Should have any queries? Drop your queries here...."></textarea><br><br><br>
			<input type="submit" name="submit" value="Send">
	</form>
	</div>
	<div class="contact-info">
		<form>
			<h3>Other ways to contact us:</h3>
			<div class="socialSites"><img src="../images/call.png">071-1672361737 </div>
			<div class="socialSites"><img src="../images/mail.png">management@woodland.ac.uk</div>
			<a class="socialSites" href="https://www.facebook.com" target="_blank"> <img src="../images/facebook.png"></a>Facebook<br>
			<a class="socialSites" href="https://twitter.com" target="_blank"><img src="../images/twitter.png"></a>Twitter<br>
			<a class="socialSites" href="https://www.pinterest.com" target="_blank"><img src="../images/pinterest.png"></a>Pinterest<br>
			<a class="socialSites" href="https://www.youtube.com" target="_blank"><img src="../images/youtube.png"></a>Youtube<br>
			<a class="socialSites" href="https://www.linkedin.com" target="_blank"><img src="../images/linkedin.png"></a>Linkedin<br>
			<a class="socialSites" href="https://www.viber.com" target="_blank"><img src="../images/viber.png"></a>Viber: 071-1672361737<br><br>
		</form><br>
	</div>
</section>

<?php 
	require 'footer.php';
?>
<?php
	$title = "WUC - Home";
	require 'header.php';
	require '../databaseConnection/connectdb.php';
?>
<section>
	<article>
		<div id="keyFrameImages">
			<img class="mySlides" src="../images/image5.jpg" alt="image 1">
			<img class="mySlides" src="../images/image4.jpg" alt="image 2">
			<img class="mySlides" src="../images/image3.jpg" alt="image 3">
			<img class="mySlides" src="../images/image2.jpg" alt="image 4">
			<img class="mySlides" src="../images/image1.jpg" alt="image 5">
		</div>
	</article>
	<div class="row0">
		<div class="row0col1">
			<h3>Welcome</h3>
			<video height="300px" width="300px" controls><source src="../videos/Facebook1.mp4" type="video/mp4"></video>
		</div>
		<div class="row0col2">
			<h3>News</h3>
			<p>Woodlands University College (WUC) is a small Higher Education institution offering a wide range of degree courses.</p>
		</div>
		<div class="row0col3">
			<h3>Notice</h3>
			<p>Woodlands University College (WUC) is a small Higher Education institution offering a wide range of degree courses.</p>
		</div>
	</div>
	<div class="row1">
		<div class="row1col1">
			<h3>Why choose us?</h3>
			<p>Woodland Uninversity College offers more than just a good degree. Our unique approach to social enterprise and our global reputation for producing graduates with exceptional employability reflects our commitment to this, making us ​the choice for your future.</p>
		</div>
		<div class="row1col2">
			<h3>Our Courses</h3>
			<?php 
				$course = $pdo->prepare("SELECT * FROM courses");
				$course->execute();
				foreach ($course as $key) {
					echo '<ul><li>'.$key['course_title'].'</li></ul>';
				}
			?>
		</div>
		<div class="row1col3">
			<h3>Notable Alumini</h3>
			<img src="../images/image1.jpg"><p>Image1</p><br>
			<img src="../images/image2.jpg"><p>Image1</p>
			<h5><a href="#">Read More...</a></h5>
		</div>
	</div>
	<div class="row2">
		<div class="row2col1">
			
		</div>
		<div class="row2col2">
			
		</div>
		<div class="row2col3">
			
		</div>
	</div>
	<div class="row3">
		<div class="row3col1">
			
		</div>
		<div class="row3col2">
			
		</div>
		<div class="row3col3">
			
		</div>
	</div>
</section>

<?php 
	require 'footer.php';
?>
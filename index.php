<?php
 require_once "start.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Achieve success</title>
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Open+Sans|Raleway" rel="stylesheet">
	<link rel="stylesheet" href="styles/flexslider.css">
	<link rel="stylesheet" href="styles/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles/style.css">
	
</head>
<body id="top" data-spy="scroll">
	<!--top header-->

	<header id="home">

		<section class="top-nav hidden-xs">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="top-left">

							<ul>
								<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-vk" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							</ul>

						</div>
					</div>

					<div class="col-md-6">
						<div class="top-right">
							<p>Location:<span>Inha University Street 2020, Tashkent, Uzbekistan</span></p>
						</div>
					</div>

				</div>
			</div>
		</section>

		<!--main-nav-->

		<div id="main-nav">

			<nav class="navbar">
				<div class="container">

					<div class="navbar-header">
						<a href="index.php" class="navbar-brand"></a>
						<!--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#ftheme">
							<span class="sr-only">Toggle</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>-->
					</div>

					<div class="navbar-collapse collapse" id="ftheme">

						<ul class="nav navbar-nav navbar-right">
							<li ><a href="#home">home</a></li>
							<li ><a href="#about " >about</a></li>
							<li ><a href="#solution" >solution</a></li>
							<li><a href="#rating">Rating</a></li>
							<li ><a href="#company">Compamy</a>
							</li>
							<li><a href="#contact">contact</a></li>
							<li> <button class="btn" onclick="window.location='login.php';" value="Register">Sign in </button></li>
							<li> <button class="btn" onclick="window.location='reg.php';" value="Register">Register </button></li>
							 <!-- <li class="hidden-sm hidden-xs">
	                          <a href="#" id="ss"><i class="fa fa-search" aria-hidden="true"></i></a> 
	                        </li>-->
						</ul>

					</div>

					<div class="search-form">
	                    <form>
	                        <input type="text" id="s" size="40" placeholder="Search..." />
	                    </form>
	                </div>

				</div>
			</nav>
		</div>

	</header>

	<!--slider-->
	<div id="slider" class="flexslider">

        <ul class="slides">
            <li>
            	<img src="images/slider/slider1.jpg">

				<div class="caption">
					<p> <br> <br> <br><br><h2><span>Teachers</span></h2> 
					<h2><span>Improve Teaching Skills</span></h2></p>
					        
	            </div>

            </li>
            <li>
            	<img src="images/slider/slider2.jpg">

				<div class="caption">
					<p> <br> <br> <br><br><br><br><h2><span>Exchange your skills</span></h2> </p>
					              
	            </div>

            </li>
            <li>
            	<img src="images/slider/slider3.jpg">

				<div class="caption">
					<p> <br> <br> <br><br><h2><span>Teachers Rate</span></h2> 
					<h2><span>Be the best Teacher</span></h2>            
	            </div>

            </li>
        </ul>

    </div>

    <!--about-->
    <div id="about">

    	<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
					<div class="about-heading">
						<h2>about</h2> 
						<p>...</p>
					</div>
				</div>
			</div>   	
    	</div>

    	<!--about wrapper left-->
    	<div class="container">

    		<div class="row">
    			<div class="col-xs-12 hidden-sm col-md-5">

    				<div class="about-left">
    					<img src="images/about/school.jpg" alt="">
    				</div>

    			</div>

    			<!--about wrapper right-->
    			<div class="col-xs-12 col-md-7">
    				<div class="about-right">
    					<div class="about-right-heading">
    						<h1>about our website</h1>
    					</div>
  
    					<div class="about-right-boot">
    						<div class="about-right-wrapper">
	    						<h3>The Syllabus Problem</h3>
	    						
								<p>How to decide on the themes, topics, &content
								
								<br>Difficulty of developing a logical or learnable sequence for other syllabus if topics are the framework</p>
    						</div>
    					</div>

    					<div class="about-right-best">
    						<div class="about-right-wrapper">
	    						<a href="problems.html"><h3>Problems for Teachers That Limit Their Overall Effectiveness</h3></a>
	    						<p>Teaching is a difficult profession. There are many problems for teachers that make the profession more complicated than it has to be.</p>
    						</div>
    					</div>

    					<div class="about-right-support">
    						<div class="about-right-wrapper">
	    						<a href="effective.html"><h3>We help You</h3></a>
	    						<p>Go to solutions and overcomes from your problems</p>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>

            


    	</div>
    </div>

	<!--about bg-->
		<div id="about-bg">

			<div class="container">
				<div class="row">

					

				</div>
			</div>

			<div class="cover"></div>

		</div> 

		<!--solution-->
		<div id="solution">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-6 col-md-offset-3">
						<div class="solutionheading">
							<h2>Solutions</h2> 
							<p>Teachers as a leader is the centerprice linking classroom and school environment</p>
						</div>
					</div>
				</div>   	
	    	</div>

			<!--solutions wrapper-->
    <section class="solutionsStyleOne">
    	<div class="outer-box clearfix">
    		
            <div class="solutionscolumn">
            	<div class="content-outer">
                	<div class="row clearfix">
                    	
                        <div class="solutionblock col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        	<div class="inner-box">
                            	<div class="icon-box"><i class="fa fa-briefcase" aria-hidden="true"></i></div>
                            	<a href="best.html"><h4>Teacher Experience</h4> </a>
                                
                                <div class="text">TeachMan empowers teachers with unprecedented flexibility to customize courses and the student learning experience. Teachers and Administrators can alter the instructional sequence of Courses, insert Units, Lessons, Projects or Quizzes from other courses, insert Teacher-Syllabus, Custom Lessons, delete or skip lessons and set individual course levels for every student. <br><br></div>
                            </div>
                        </div>
                        
                        <div class="solutionblock col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        	<div class="inner-box">
                            	<div class="icon-box"><i class="fa fa-bar-chart" aria-hidden="true"></i></div>
                            	<a href="planning.html"><h4>DASHBOARDS AND REPORTING</h4> </a>
                                <div class="text">The intuitive TeachMan data and instructional management portal allows teachers to easily manage and customize courses, create and assign tailored courses, monitor student progress, grade student work and communicate with their students. </div>
                            </div>
                        </div>
                        
                        <div class="solutionblock col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        	<div class="inner-box">
                            	<div class="icon-box"><i class="fa fa-trophy" aria-hidden="true"></i></div>
                                <h4>TEACHER RATING</h4>
                                <div class="text">According to teachers activity and performance their rating are calculated </div>
                            </div>
                        </div>
                        
                       
                    </div>


                    
                </div>
            </div>

            <!--Content Column-->
            <div class="content-column clearfix">
                <div class="content-box">
                	<div class="inner-box">
                        <!--Section Title-->
                        <div class="sec-title aligned-right">
                            <h2>Our Solu<span>tions</span></h2>
                        </div>
                        <div class="text">CLICK BELOW TO EXPLORE THE MANY WAYS EDUCATORS ARE LEVERAGING ODYSSEYWARE® CURRICULUM AND INSTRUCTIONAL TOOLS. </div>
                    </div>
                </div>
            </div>


        </div>
    </section>



			<!--solution gapping-->
			<div class="solutionfooter hidden-xs">
				<div class="container">
					<div class="row">
						<div class="col-md-7">
							<div class="solutionfooterLeft">
								<h3> <span> TeachMan</span> REGISTER NOW</h3>
								<p>The TeachMan that's the way we all became the best Teacher</p>
							</div>
						</div>

						<div class="col-md-5">
							<div class="solutionfooterRight">
								<button class="btn" onclick="window.location='index.php';" value="Register">Register</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--portfolio-->
		<div id="rating">
			<div class="container">
				<div class="row">

					<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
						<div class="ratingheading">
							<h2>Rating</h2> 
							<p>...</p>
						</div>
					</div>

				</div>   	
	    	</div>

	    	<div class="ratingthumbnail">
	    		<div class="container-fluid">
	    			<div class="row">

	    				<div class="col-xs-6 col-sm-3 col-md-3">
	    					<div class="item">
	    						<img src="images/portfolio/portfolio1.jpg" alt="">
	    						<div class="caption">
                               		<i class="fa fa-search" aria-hidden="true"></i>
                               		<p>lorem ipsum amet</p>
                            	</div>
	    					</div>
	    				</div>

	    				<div class="col-xs-6 col-sm-3 col-md-3">
	    					<div class="item">
	    						<img src="images/portfolio/portfolio2.jpg" alt="">
	    						<div class="caption">
                               		<i class="fa fa-search" aria-hidden="true"></i>
                               		<p>lorem ipsum amet</p>
                            	</div>
	    					</div>
	    				</div>

	    				<div class="col-xs-6 col-sm-3 col-md-3">
	    					<div class="item">
	    						<img src="images/portfolio/portfolio3.jpg" alt="">
	    						<div class="caption">
                               		<i class="fa fa-search" aria-hidden="true"></i>
                               		<p>lorem ipsum amet</p>
                            	</div>
	    					</div>
	    				</div>

	    				<div class="col-xs-6 col-sm-3 col-md-3">
	    					<div class="item">
	    						<img src="images/portfolio/portfolio4.jpg" alt="">
	    						<div class="caption">
                               		<i class="fa fa-search" aria-hidden="true"></i>
                               		<p>lorem ipsum amet</p>
                            	</div>
	    					</div>
	    				</div>

	    				<div class="col-xs-6 col-sm-3 col-md-3">
	    					<div class="item">
	    						<img src="images/portfolio/portfolio5.jpg" alt="">
	    						<div class="caption">
                               		<i class="fa fa-search" aria-hidden="true"></i>
                               		<p>what you see</p>
                            	</div>
	    					</div>
	    				</div>

	    				<div class="col-xs-6 col-sm-3 col-md-3">
	    					<div class="item">
	    						<img src="images/portfolio/portfolio6.jpg" alt="">
	    						<div class="caption">
                               		<i class="fa fa-search" aria-hidden="true"></i>
                               		<p>lorem ipsum amet</p>
                            	</div>
	    					</div>
	    				</div>

	    				<div class="col-xs-6 col-sm-3 col-md-3">
	    					<div class="item">
	    						<img src="images/portfolio/portfolio7.jpg" alt="">
	    						<div class="caption">
                               		<i class="fa fa-search" aria-hidden="true"></i>
                               		<p>lorem ipsum amet</p>
                            	</div>
	    					</div>
	    				</div>

	    				<div class="col-xs-6 col-sm-3 col-md-3">
	    					<div class="item">
	    						<img src="images/portfolio/portfolio8.jpg" alt="">
	    						<div class="caption">
                               		<i class="fa fa-search" aria-hidden="true"></i>
                               		<p>lorem ipsum amet</p>
                            	</div>
	    					</div>
	    				</div>

	    			</div>
	    		</div>
	    	</div>
		</div>

		<!--contact form-->
		<div id="company">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
						<div class="companyheading">
							<h2>TEACHMAN</h2> 
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent metus magna,malesuada porta elementum vitae.</p>
						</div>
					</div>
				</div>   

				<div class="content">
	                <div class="row">
                        <div id="sendmessage">Your message has been sent. Thank you!</div>
                        <div id="errormessage"></div>
                        
                         <form action="" method="post" role="form" class="form contactForm">
	                        <div class="col-md-4">
	                            <div class="form-group">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                    <div class="validation"></div>
                                </div>
	                        </div>
	                        <div class="col-md-4">
	                            <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                    <div class="validation"></div>
                                </div>
	                        </div>
	                        <div class="col-md-4">
	                            <div class="form-group">
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                    <div class="validation"></div>
                                </div>
	                        </div>
	                        <div class="col-md-12">
	                            <div class="form-group">
                                    <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                                    <div class="validation"></div>
                                </div>
	                        </div>
	                        <div class="submit">
	                            <button class="btn btn-default" type="submit">Send Now</button>
	                        </div>
	                    </form>
	                </div>
            </div>	
	    	</div>
		</div>


		<!--contact-->
		<div id="contact">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
						<div class="contact-heading">
							<h2>contact</h2> 
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent metus magna,malesuada porta elementum vitae.</p>
						</div>
					</div>
				</div>   	
	    	</div>

	    	<div id="google-map" data-latitude="40.713732" data-longitude="-74.0092704"></div>
            
		</div>


		

		<!--footer-->
		<div id="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="footer-heading">
							<h3><span>about</span> us</h3>
							<p>To explore strange new worlds to seek out new life and new civilizations to boldly go where no man has gone before. It's time to play the music.</p>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="footer-heading">
							<h3><span>latest</span> news</h3>
							<ul>
								<li><a href="#">Trends don't matter, but techniques do</a></li>
								<li><a href="#">Trends don't matter, but techniques do</a></li>
								<li><a href="#">Trends don't matter, but techniques do</a></li>
								<li><a href="#">Trends don't matter, but techniques do</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-4">
						<div class="footer-heading">
							<h3><span>follow</span> us on instagram</h3>
							<div class="insta">
								<ul>
									<img src="images/footer/footer1.jpg" alt="">
									<img src="images/footer/footer2.jpg" alt="">
									<img src="images/footer/footer3.jpg" alt="">
									<img src="images/footer/footer4.jpg" alt="">
									<img src="images/footer/footer5.jpg" alt="">
									<img src="images/footer/footer6.jpg" alt="">
								</ul>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<!--bottom footer-->
		<div id="bottom-footer" class="hidden-xs">
			<div class="container">
				<div class="row">
					

					<div class="col-md-8">
						<div class="footer-right">
                            <ul class="list-unstyled list-inline pull-right">
                                <li><a href="#home">Home</a></li>
                                <li><a href="#about">About</a></li>
                                <li><a href="#solution">Solutions</a></li>
                                <li><a href="#rating">Portfolio</a></li>
                                <li><a href="#contact">Contact</a></li>
                            </ul>
						</div>
					</div>
				</div>
			</div>
		</div>
        

	
	<!-- jQuery -->
    <script src="scripts/bootstrap/jquery.js"></script>
    <script src="scripts/bootstrap/bootstrap.min.js"></script>
    <script src="scripts/jquery.flexslider.js"></script>
    <script src="scripts/jquery.inview.js"></script>
    <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="scripts/script.js"></script>
</body>
</html>
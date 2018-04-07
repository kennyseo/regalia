
<?php
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
	header("Pragma: no-cache");
	//require_once("./ldap/session.php");


	include("includes/header.php");

	include("includes/nav.php");
?>
<body class="landing">
   <div id="skip"><a href="#content">Skip navigation</a></div>
   <div id="header-bg"></div>
   <div class="container" id="opener" role="banner"><a class="brand" href="http://www.uark.edu/">University of Arkansas</a><h1 id="site-heading"><!-- college header/name/info goes here --> <a class="rale" title="The University Bookstore" href="http://bookstore.uark.edu">The University Bookstore</a></h1>

   </div>

   <div id="main-container" role="main">





      <section class="landingPage">

         <div id="main-container" class="container opener">

            <p>&nbsp;</p>

            <h2 id="the-university-bookstore" style="font-weight: 200;">The University Bookstore</h2>

            <p class="rale">The University of Arkansas Bookstore is constantly working to provide customers with
               the best possible pricing on textbooks, school supplies and academic materials. The
               Bookstore monitors not only the local market, but also the national market on a daily
               basis to ensure pricing is competitive within the marketplace. A recent report from
               the National Association of College Stores has shown that University Bookstore pricing
               is, in average, 3-5% lower than the National average. Bookstore also offers about
               $500,000 in discounts to students, faculty, and staff through seasonal promotions.
            </p>

            <p>&nbsp;</p>

         </div>

      </section>




   </div>


<?php
	include("includes/footer.php");
?>

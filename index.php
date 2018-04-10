
<?php
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
	header("Pragma: no-cache");
	//require_once("./ldap/session.php");

	include("includes/header.php");
	include("includes/nav.php");
	require_once("includes/connection.php");

?>


<div class="container mt-6">
	<div class="row">
		<div class="col-md-12 text-center">
			<h2 class="rale2">Razorback Shop</h2>
			<a class="btn-xl btn-bkst" href="https://shop.uofastore.com/c-88-apparel.aspx">SHOP ONLINE</a><br />
			<a class="btn-xl btn-bkst" href="https://shop.uofastore.com/t-hours.aspx">Razorback Shops &amp; Garland Center Hours</a>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<h2 class="rale2">Razorback Shop</h2>
			<a class="btn-xl btn-bkst" href="https://shop.uofastore.com/c-88-apparel.aspx">SHOP ONLINE</a><br />
			<a class="btn-xl btn-bkst" href="https://shop.uofastore.com/t-hours.aspx">Razorback Shops &amp; Garland Center Hours</a>
		</div>
	</div>
</div>

<?php
	include("includes/footer.php");
?>

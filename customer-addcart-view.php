<?php require_once("authin-customer.php"); ?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="canonical" href="https://getbootstrap.com/docs/3.4/examples/navbar/">

    <title>Home</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/3.4/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="https://getbootstrap.com/docs/3.4/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/3.4/examples/navbar/navbar.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="https://getbootstrap.com/docs/3.4/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

     <?php //include 'admin-nav-bar-view.php'; ?>

	 <?php include('customer-nav-bar-view.php');?>
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
			
	  <div>	

<?php


include("connect_db.php");

$email_owner=$_SESSION['session_email'];
$product_id = $_GET['product_id'];

$query = "SELECT * FROM product_tb WHERE
			product_id= '$product_id'";
		$result = mysqli_query($con,$query);
		$rows = mysqli_fetch_assoc($result);

			$image = $rows['image'];
			$product_id = $rows['product_id'];
			$productname = $rows['productname'];
			$productdesc = $rows['productdesc'];
			$price = $rows['price'];

			$qry = "SELECT * FROM customer_tb
		  WHERE cemail = '$email_owner' ";
		$list = mysqli_query($con,$qry);
		$record = mysqli_fetch_assoc($list);


if(empty($rows&&$record)){
	?>
	User does not exist.<br /><br/>
	<a href='customer-home-view.php'>Click here</a> to go back
	<?php
} else {

?>
<div>
<div>
<div>


<table width="80%" class="table">
<tr>
	<td>Image</td>
	<td>ProductNo</td>
	<td>ProductName</td>
	<td>Product Description</td>
	<td>Price</td>
	<td>Quantity</td>


</tr>

	<tr>
	<th><strong><img  src="<?php echo $image;?>" style="margin-top:20px;height:100px;width:100px;"/></strong></th>
	
	<th><strong><?php echo ($product_id); ?></strong></th>
	<th><strong><?php echo ($productname); ?></strong></th>
	<th><strong><?php echo ($productdesc); ?></strong></th>
	<th><strong><?php echo '₱'.$price.'.00'; ?></strong></th>

	<th>
	<form method='post' enctype='multipart/form-data' action='customer-addcart-process.php'>
<?php //ayaw ni hilabti ?>
	<input type='hidden' name='product_id' value='<?php echo $product_id; ?>'/>
	<input type='hidden' name='productname' value='<?php echo $productname; ?>'/>
	<input type='hidden' name='productdesc' value='<?php echo $productdesc; ?>'/>
	<input type='hidden' name='price' value='<?php echo $price; ?>'/>
	<input type='hidden' name='email' value='<?php echo $email_owner; ?>'/>
  
  <?php //kani pwede ni hilabti ?>
  <select name="itemno" class="form-control">
  	<?php 
  	for($i=1;$i<100;$i++)
  		{?>
    <option><?php echo $i;?></option>
    <?php }?>
  </select>
  <br/>
  <input type='submit' value='Add to Cart' name='submit'  style='width:250px;' class="form-control">
		</form> 

</th>
</tr>
</table>
</div>
	


</div>
<?php } ?>
</div>

	</div>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="https://getbootstrap.com/docs/3.4/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://getbootstrap.com/docs/3.4/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="https://getbootstrap.com/docs/3.4/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
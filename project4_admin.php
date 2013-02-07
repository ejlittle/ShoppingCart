<?php
	include("db_connect.php");
	$login_test = 0;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Eric Little || Project 4</title>
</head>

<body bgcolor="#FFCC00">
<center>
<?php
#########################################
###########################################
#############################################
//									FUNCTIONS
#############################################
###########################################
#########################################
	function logout()
	{
		print('<p align="right"><a href="project4_admin.php">LOG OUT</a></p>');
	}
	
	function login_form()
	{
		print('
			<center>
			<p>Admin?  Login below!</p>
			<form name="login" method="post" action="">
			<table border = 0>
				<tr><td align="right"><label>Username</label></td>
					<td><input name="username" type="text" /></td></tr>    
				<tr><td align="right"><label>Password</label></td>
					<td><input name="password" type="password" /></td></tr>
			</table>
				<input name="submit_login" type="submit" value="SUBMIT" />
			
			<p>Not an admin?  Click <a href="project3.php">here</a> to shop at our site!</p>
			</form>
			</center>
		');
	}
	
	function failed_login()
	{
		print('
			<center>
			<p>Username and/or password were incorrect, please try logging in again.</p>
			<form name="login" method="post" action="">
			<table>
				<tr><td align="right"><label>Username</label></td>
					<td><input name="username" type="text" /></td></tr>    
				<tr><td align="right"><label>Password</label></td>
					<td><input name="password" type="password" /></td></tr>
			</table>
				<input name="submit_login" type="submit" value="SUBMIT" />
			
			<p>Not an admin?  Click <a href="project3.php">here</a> to shop at our site!</p>
			</form>
			</center>
		');
	}
	
	function view_orders()
	{
		print ('<table border=1><form name="orderstatus" method="post" action="">');
		$select_query = "SELECT * FROM a3orders WHERE order_status = 0";
    	$result = mysql_query($select_query) or die ("select failed");
		print ('<tr><th>ORDER ID</th><th>USER</th><th>SKU</th><th>QUANTITY</th><th>SHIPPING STATUS</th><th>SHIPPED?</th></tr>');
		while($row = mysql_fetch_assoc($result))
		{
			print ('<tr><td>'.$row['oid'].'</td><td>'.$row['uid'].'</td><td>'.$row['sku'].'</td><td>'.$row['quantity'].'</td><td>'.$row['order_status'].'</td><td><input type="radio" name="'.$row['oid'].'" value="'.$row['oid'].'" /></td>');
		}
		print ('</table>');
		print ('<input type="submit" name="updateorder" value="UPDATE ORDER STATUS"><br />');
		print ('<input type="submit" name="viewshipped" value="VIEW SHIPPED ORDERS"><br />');
		print ('</form>');
	}
	
	function update_order()
	{
		foreach($_POST as $key)
		{
			$insert_query = "UPDATE a3orders SET order_status = 1 WHERE oid = '".$_POST[$key]."'";
			$insert_result = mysql_query($insert_query) or die('Insert Query Failed');;
		}
	}
	
	function recall_shipping()
	{
		foreach($_POST as $key)
		{
			$insert_query = "UPDATE a3orders SET order_status = 0 WHERE oid = '".$_POST[$key]."'";
			$insert_result = mysql_query($insert_query) or die('Insert Query Failed');;
		}
	}
	
	function view_shipped()
	{
		print ('<table border=1><form name="orderstatus" method="post" action="">');
		$select_query = "SELECT * FROM a3orders WHERE order_status = 1";
    	$result = mysql_query($select_query) or die ("select failed");
		print ('<tr><th>ORDER ID</th><th>USER</th><th>SKU</th><th>QUANTITY</th><th>SHIPPING STATUS</th><th>NOT SHIPPED?</th></tr>');
		while($row = mysql_fetch_assoc($result))
		{
			print ('<tr><td>'.$row['oid'].'</td><td>'.$row['uid'].'</td><td>'.$row['sku'].'</td><td>'.$row['quantity'].'</td><td>'.$row['order_status'].'</td><td><input type="radio" name="'.$row['oid'].'" value="'.$row['oid'].'" /></td>');
		}
		print ('</table>');
		print ('<input type="submit" name="recallshipping" value="RECALL SHIPPING STATUS"><br />');
		print ('<input type="submit" name="notshipped" value="VIEW UNSHIPPED ORDERS"><br />');
		print ('</form>');
	}
	
#########################################
###########################################
#############################################
//								END FUNCTIONS
#############################################
###########################################
#########################################
?>

<?php
##############################################
############################################
##########################################
//								PAGE LOGIC
##########################################
############################################
##############################################

	if(isset($_POST["submit_login"]))
	{
	    $select_query = "SELECT * FROM a4admins";
    	$result = mysql_query($select_query) or die ("select failed");
		while($row = mysql_fetch_assoc($result))
		{
			if(($_POST['username'] == $row['adminUser']) && (md5($_POST['password']) == $row['adminPassword']))
			{
				$login_test = 1;
			}
		}
		
		if($login_test == 1)
		{
			logout();
			print("<h2>Fruit Store Admin</h2>");
			print ('<form method="post" action=""><input type="submit" name="notshipped" value="VIEW UNSHIPPED ORDERS"><br />');
			print ('<input type="submit" name="viewshipped" value="VIEW SHIPPED ORDERS"><br /></form>');
			
		}
		else
		{
			failed_login();
		}
	}
	else if(isset($_POST["updateorder"]))
	{
		logout();
		print("<h2>Unshipped Orders</h2>");
		update_order();
		print("Shipping Status Successfully Updated");
		print("<br />");
		view_orders();
	}
	else if(isset($_POST["recallshipping"]))
	{
		logout();
		print("<h2>Shipped Orders</h2>");
		recall_shipping();
		print("Shipping Status Successfully Recalled");
		print("<br />");
		view_shipped();
	}
	else if(isset($_POST["notshipped"]))
	{
		logout();
		print("<h2>Unshipped Orders</h2>");
		view_orders();
	}
	else if(isset($_POST["viewshipped"]))
	{
		logout();
		print("<h2>Shipped Orders</h2>");
		view_shipped();
	}
	else
	{
		login_form();
	}
		
	mysql_close($connect);
##############################################
############################################
##########################################
//							END PAGE LOGIC
##########################################
############################################
##############################################
?>
</center>
</body>
</html>
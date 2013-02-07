<?php
	include("db_connect.php");
	$login_test = 0;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Eric Little || Project 3</title>
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
		print('<p align="right"><a href="project3.php">LOG OUT</a></p>');
	}
	
	function login_form()
	{
		print('
			<center>
			<p>Returning customer?  Login below!</p>
			<form name="login" method="post" action="">
			<table border = 0>
				<tr><td align="right"><label>Username</label></td>
					<td><input name="username" type="text" /></td></tr>    
				<tr><td align="right"><label>Password</label></td>
					<td><input name="password" type="password" /></td></tr>
			</table>
				<input name="submit_login" type="submit" value="SUBMIT" />
			
			<p>New customer?  Click <a href="project3_create.php">here</a> to create an account!</p>
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
			
			<p>New customer?  Click <a href="project3_create.php">here</a> to create an account!</p>
			</form>
			</center>
		');
	}
	
	function shopping_page()
	{
		$shop_query = "SELECT * FROM a3stock";
   		$shop_result = mysql_query($shop_query);
		
		if(isset($_POST['username']))
		{
			$select_query = "SELECT uid FROM a3users WHERE user = '".$_POST['username']."'";
			$select_result = mysql_query($select_query);
			$uid = mysql_fetch_assoc($select_result);
			$user = $uid['uid'];
		}
		else if(isset($_POST['user']))
		{
			$user = $_POST['user'];
		}
		
		$name_query = "SELECT first_name FROM a3user_info WHERE uid = '".$user."'";
		$name_result = mysql_query($name_query);
		$name = mysql_fetch_assoc($name_result);
		
		print('<h3>Welcome to the Fruit Store, '.$name['first_name'].'!</h3>');
		//print('<form name="shop" method="post" action="">');
	   	print('<table border = 1>');
		print('<tr><td></td><th>Fruit</th><th width="200">Description</th><th>Quantity & Price</th>');
		while($row = mysql_fetch_assoc($shop_result))
		{
			print('
				<tr>
				<form name="'.$row['name'].'" method="post" action="">
					<td><img src="'.$row['picture'].'" /></td>
					<td>'.$row['name'].'</td>
					<td>'.$row['description'].'</td>
					<td><input name="'.$row['name'].'" type="text" /> @ $'.$row['price'].'<br /><input name="check_cart" type="submit" value="ADD TO CART" /></td>
					<input name="user" type="hidden" value="'.$user.'" />
				</form>
				</tr>
			');		
		}
		print('</table>');
		print('<form name="shop_submit" method="post" action="">');
		print('<input name="check_cart" type="submit" value="VIEW CART" />');
		//print('<input name="checkout" type="submit" value="CHECK OUT" />');
		print('<input name="user" type="hidden" value="'.$user.'" />');
		print('</form>');
	}
	
	function view_cart()
	{
	$kswitch = 0;
	$bswitch = 0;
	$wswitch = 0;
	$dswitch = 0;
	$sswitch = 0;
	$user = $_POST['user'];
	
		$cart_query = "SELECT * FROM a3cart WHERE uid='".$user."'";
		$cart_result = mysql_query($cart_query) or die("cart query failed");
		
		while($cart = mysql_fetch_assoc($cart_result))
		{
			if($cart['sku'] == 1 && $_POST['Kumquat'])//Kumquat
			{
				$update_query3 = "UPDATE a3cart SET quantity = '".$_POST['Kumquat']."' WHERE sku = 1";
				$update_result3 = mysql_query($update_query3);
				$kswitch = 1;
			}
			else if($cart['sku'] == 2 && $_POST['Durian'])//Durian
			{
				$update_query3 = "UPDATE a3cart SET quantity = '".$_POST['Durian']."' WHERE sku = 2";
				$update_result3 = mysql_query($update_query3);
				$dswitch = 1;
			}
			else if($cart['sku'] == 3 && $_POST['Banana'])//Banana
			{
				$update_query3 = "UPDATE a3cart SET quantity = '".$_POST['Banana']."' WHERE sku = 3";
				$update_result3 = mysql_query($update_query3);
				$bswitch = 1;
			}
			else if($cart['sku'] == 4 && $_POST['Watermelon'])//Watermelon
			{
				$update_query3 = "UPDATE a3cart SET quantity = '".$_POST['Watermelon']."' WHERE sku = 4";
				$update_result3 = mysql_query($update_query3);
				$wswitch = 1;
			}
			else if($cart['sku'] == 5 && $_POST['Star_Fruit'])//Star Fruit
			{
				$update_query3 = "UPDATE a3cart SET quantity = '".$_POST['Star_Fruit']."' WHERE sku = 5";
				$update_result3 = mysql_query($update_query3);
				$sswitch = 1;
			}
		}
		if($kswitch == 0)
		{
			if($_POST['Kumquat'])
			{
				$insert_query = "INSERT INTO a3cart(uid, sku, quantity, order_status) VALUES ('".$user."', 1, '".$_POST['Kumquat']."', 0)";
				$insert_result = mysql_query($insert_query) or die("insert query 1 failed");
			}
		}
		if($dswitch==0)
		{
			if($_POST['Durian'])
			{
				$insert_query = "INSERT INTO a3cart(uid, sku, quantity, order_status) VALUES ('".$user."', 2, '".$_POST['Durian']."', 0)";
				$insert_result = mysql_query($insert_query) or die("insert query 2 failed");
			}
		}
		if($bswitch==0)
		{
			if($_POST['Banana'])
			{
				$insert_query = "INSERT INTO a3cart(uid, sku, quantity, order_status) VALUES ('".$user."', 3, '".$_POST['Banana']."', 0)";
				$insert_result = mysql_query($insert_query) or die("insert query 3 failed");
			}
		}
		if($wswitch==0)
		{
			if($_POST['Watermelon'])
			{
				$insert_query = "INSERT INTO a3cart(uid, sku, quantity, order_status) VALUES ('".$user."', 4, '".$_POST['Watermelon']."', 0)";
				$insert_result = mysql_query($insert_query) or die("insert query 4 failed");
			}
		}
		if($sswitch==0)
		{
			if($_POST['Star_Fruit'])
			{
				$insert_query = "INSERT INTO a3cart(uid, sku, quantity, order_status) VALUES ('".$user."', 5, '".$_POST['Star_Fruit']."', 0)";
				$insert_result = mysql_query($insert_query) or die("insert query 5 failed");
			}
		}

		print('<form name="cart_form" method="post" action="">');
		print('<table border = 1><th>Fruit</th><th>Quantity</th><th>Update?</th><th>Delete?</th>');
		$display_query = "SELECT sku, quantity FROM a3cart WHERE uid='".$user."'";
		$display_result = mysql_query($display_query);
		while($row = mysql_fetch_assoc($display_result))
		{
			print('<tr><td>');
			if($row['sku'] == 1){ print("Kumquat"); }else if($row['sku'] == 2){ print("Durian"); }else if($row['sku'] == 3){ print("Banana"); }else if($row['sku'] == 4){ print("Watermelon"); }else if($row['sku'] == 5){ print("Star Fruit"); }
			print('</td><td>'.$row['quantity'].'</td><td><input name="update'.$row['sku'].'" type="text" /></td><td><input name="delete'.$row['sku'].'" type="radio" /></td></tr>');
			$total_query = "SELECT price FROM a3stock WHERE sku ='".$row['sku']."'";
			$total_result = mysql_query($total_query);
			$tprice = mysql_fetch_assoc($total_result);
			$total_price += (($row['quantity'])*($tprice['price']));
		}
		print('</table>');
		
		print('<h3>Total: '.$total_price.'</h3>');
		print('<input name="shop" type="submit" value="CONTINUE SHOPPING">');
		print('<input name="checkout" type="submit" value="CHECK OUT" />');
		print('<input name="update_cart" type="submit" value="UPDATE CART" />');
		print('<input name="delete_item" type="submit" value="DELETE ITEM(S)" />');
		print('<input name="user" type="hidden" value="'.$user.'" />');
		print('</form>');
	}
	
	function delete_row()
	{
		$user = $_POST['user'];
		$cart_query = "SELECT * FROM a3cart WHERE uid='".$user."'";
		$cart_result = mysql_query($cart_query) or die("cart query failed");
		
		while($cart = mysql_fetch_assoc($cart_result))
		{
			if($cart['sku'] == 1 && $_POST['delete1'])//Kumquat
			{
				$update_query3 = "DELETE FROM a3cart WHERE sku = 1";
				$update_result3 = mysql_query($update_query3);
			}
			if($cart['sku'] == 2 && $_POST['delete2'])//Durian
			{
				$update_query3 = "DELETE FROM a3cart WHERE sku = 2";
				$update_result3 = mysql_query($update_query3);
			}
			if($cart['sku'] == 3 && $_POST['delete3'])//Banana
			{
				$update_query3 = "DELETE FROM a3cart WHERE sku = 3";
				$update_result3 = mysql_query($update_query3);
			}
			if($cart['sku'] == 4 && $_POST['delete4'])//Watermelon
			{
				$update_query3 = "DELETE FROM a3cart WHERE sku = 4";
				$update_result3 = mysql_query($update_query3);
			}
			if($cart['sku'] == 5 && $_POST['delete5'])//Star Fruit
			{
				$update_query3 = "DELETE FROM a3cart WHERE sku = 5";
				$update_result3 = mysql_query($update_query3);
			}
		}
	}
	
	function update_cart()
	{
		$user = $_POST['user'];
		$cart_query = "SELECT * FROM a3cart WHERE uid='".$user."'";
		$cart_result = mysql_query($cart_query) or die("cart query failed");
		
		while($cart = mysql_fetch_assoc($cart_result))
		{
			if($cart['sku'] == 1 && $_POST['update1'])//Kumquat
			{
				$update_query3 = "UPDATE a3cart SET quantity = '".$_POST['update1']."' WHERE sku = 1";
				$update_result3 = mysql_query($update_query3);
				$kswitch = 1;
			}
			else if($cart['sku'] == 2 && $_POST['update2'])//Durian
			{
				$update_query3 = "UPDATE a3cart SET quantity = '".$_POST['update2']."' WHERE sku = 2";
				$update_result3 = mysql_query($update_query3);
				$dswitch = 1;
			}
			else if($cart['sku'] == 3 && $_POST['update3'])//Banana
			{
				$update_query3 = "UPDATE a3cart SET quantity = '".$_POST['update3']."' WHERE sku = 3";
				$update_result3 = mysql_query($update_query3);
				$bswitch = 1;
			}
			else if($cart['sku'] == 4 && $_POST['update4'])//Watermelon
			{
				$update_query3 = "UPDATE a3cart SET quantity = '".$_POST['update4']."' WHERE sku = 4";
				$update_result3 = mysql_query($update_query3);
				$wswitch = 1;
			}
			else if($cart['sku'] == 5 && $_POST['update5'])//Star Fruit
			{
				$update_query3 = "UPDATE a3cart SET quantity = '".$_POST['update5']."' WHERE sku = 5";
				$update_result3 = mysql_query($update_query3);
				$sswitch = 1;
			}
		}

		print('<form name="cart_form" method="post" action="">');
		print('<table border = 1><th>Fruit</th><th>Quantity</th><th>Update?</th><th>Delete?</th>');
		$display_query = "SELECT sku, quantity FROM a3cart WHERE uid='".$user."'";
		$display_result = mysql_query($display_query);
		while($row = mysql_fetch_assoc($display_result))
		{
			print('<tr><td>');
			if($row['sku'] == 1){ print("Kumquat"); }else if($row['sku'] == 2){ print("Durian"); }else if($row['sku'] == 3){ print("Banana"); }else if($row['sku'] == 4){ print("Watermelon"); }else if($row['sku'] == 5){ print("Star Fruit"); }
			print('</td><td>'.$row['quantity'].'</td><td><input name="update'.$row['sku'].'" type="text" /></td><td><input name="delete'.$row['sku'].'" type="radio" /></td></tr>');
			$total_query = "SELECT price FROM a3stock WHERE sku ='".$row['sku']."'";
			$total_result = mysql_query($total_query);
			$tprice = mysql_fetch_assoc($total_result);
			$total_price += (($row['quantity'])*($tprice['price']));
		}
		print('</table>');
		
		print('<h3>Total: '.$total_price.'</h3>');
		print('<input name="shop" type="submit" value="CONTINUE SHOPPING">');
		print('<input name="checkout" type="submit" value="CHECK OUT" />');
		print('<input name="update_cart" type="submit" value="UPDATE CART" />');
		print('<input name="delete_item" type="submit" value="DELETE ITEM(S)" />');
		print('<input name="user" type="hidden" value="'.$user.'" />');
		print('</form>');
	}
	
	function cc_gateway()
	{
		$user = $_POST['user'];
	
		print('<h3>Input 5555555555555555 to make this credit card gateway succeed.</h3>');
		print('<form name="ccgateway" method="post" action="" />');
		print('<input name="cc_number" type="text" />');
		print('<input name="user" type="hidden" value="'.$user.'" />');
		print('<input name="shop" type="submit" value="CONTINUE SHOPPING">');
		print('<input name="pay" type="submit" value="SUBMIT PAYMENT">');
		print('</form>');
	}
	
	function process_cc()
	{
		$user = $_POST['user'];
		
		if($_POST['cc_number'] == 5555555555555555)
		{
			$trans_query = "SELECT * FROM a3cart WHERE uid='".$user."'";
			$trans_result = mysql_query($trans_query) or die("select failed");
			while($row = mysql_fetch_assoc($trans_result))
			{
				$move_query = "INSERT INTO a3orders(uid, sku, quantity, order_status) VALUES ('".$row['uid']."', '".$row['sku']."', '".$row['quantity']."', '".$row['order_status']."')";
				$move_result = mysql_query($move_query) or die("transfer failed");
				$delete_query = "DELETE FROM a3cart WHERE uid='".$user."'";
				$delete_result = mysql_query($delete_query) or die("delete failed");
			}
			$name_query = "SELECT first_name FROM a3user_info WHERE uid = '".$user."'";
			$name_result = mysql_query($name_query);
			$name = mysql_fetch_assoc($name_result);
			
			print('<h3>Thank you, '.$name['first_name'].'.  You should recieve your shipment of fruit in 7-14 business days.</h3>');
			print('<form name="cc_confirm" method="post" action="" />');
			print('<input name="user" type="hidden" value="'.$user.'" />');
			print('<input name="shop" type="submit" value="CONTINUE SHOPPING">');
			print('</form>');
		}
		else
		{
			print('<h3>Invalid Credit Card Number</h3>');
			print('<form name="cc_fail" method="post" action="" />');
			print('<input name="user" type="hidden" value="'.$user.'" />');
			print('<input name="shop" type="submit" value="CONTINUE SHOPPING">');
			print('<input name="checkout" type="submit" value="DIFFERENT PAYMENT">');
			print('</form>');
		}
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
	    $select_query = "SELECT * FROM a3users";
    	$result = mysql_query($select_query) or die ("select failed");
		while($row = mysql_fetch_assoc($result))
		{
			if(($_POST['username'] == $row['user']) && (md5($_POST['password']) == $row['password']))
			{
				$login_test = 1;
			}
		}
		
		if($login_test == 1)
		{
			logout();
			shopping_page();
		}
		else
		{
			failed_login();
		}
	}
	else if(isset($_POST["update_cart"]))
	{
		logout();
		update_cart();
	}
	else if(isset($_POST["check_cart"]))
	{
		logout();
		view_cart();
	}
	else if(isset($_POST["checkout"]))
	{
		logout();
		cc_gateway();
	}
	else if(isset($_POST["pay"]))
	{
		logout();
		process_cc();
	}
	else if(isset($_POST["shop"]))
	{
		logout();
		shopping_page();
	}
	else if(isset($_POST["delete_item"]))
	{
		delete_row();
		logout();
		shopping_page();
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
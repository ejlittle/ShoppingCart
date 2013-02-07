<?php
	include("db_connect.php");
	$user_test = 0;
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
#############################################
//									FUNCTIONS
#############################################

	function test_invalid($array) 
	{
		foreach ($array as $field) 
		{
			if (test_empty($field) == true) 
			{
				return true;
			}
		}
	}
		
	function test_empty($field) 
	{
		return empty($field);
	}
		
	function test_valid($field) 
	{
		if (test_empty($field) == true)
		{
			return "ERROR 101: Empty input, field must contain information.";
		}
	}

	function create_form()
	{
		print(' 
			<h3>Fill out the following information to create a user profile.</h3>
			<form name="login" method="post" action="">
				<table border = 0><tr><td align="right"><label>Username</label></td>
					<td><input type="text" name="username" /></td></tr>
				<tr><td align="right"><label>Password</label></td>
					<td><input type="password" name="password" /></td></tr>
				<tr><td align="right"><label>Email Address</label></td>
					<td><input type="text" name="email" /></td></tr></table>
				
				<h3>Shipping Information</h3>
				<table border = 0><tr><td align="right"><label>First Name</label></td>
					<td><input type="text" name="fname" /></td></tr>
				<tr><td align="right"><label>Last Name</label></td>
					<td><input type="text" name="lname" /></td></tr>
				<tr><td align="right"><label>Street Address</label></td>
					<td><input type="text" name="street" /></td></tr>
				<tr><td align="right"><label>City</label></td>
					<td><input type="text" name="city" /></td></tr>
				<tr><td align="right"><label>State</label></td>
					<td><select name="state">
						<option value="">Select one...</option>
						<option value="AL">AL - Alabama</option>
						<option value="AK">AK - Alaska</option>
						<option value="AZ">AZ - Arizona</option>
						<option value="AR">AR - Arkansas</option>
						<option value="CA">CA - California</option>
						<option value="CO">CO - Colorado</option>
						<option value="CT">CT - Connecticut</option>
						<option value="DE">DE - Delaware</option>
						<option value="DC">DC - District of Columbia</option>
						<option value="FL">FL - Florida</option>
						<option value="GA">GA - Georgia</option>
						<option value="HI">HI - Hawaii</option>
						<option value="ID">ID - Idaho</option>
						<option value="IL">IL - Illinois</option>
						<option value="IN">IN - Indiana</option>
						<option value="IA">IA - Iowa</option>
						<option value="KS">KS - Kansas</option>
						<option value="KY">KY - Kentucky</option>
						<option value="LA">LA - Lousiana</option>
						<option value="ME">ME - Maine</option>
						<option value="MD">MD - Maryland</option>
						<option value="MA">MA - Massachusetts</option>
						<option value="MI">MI - Michigan</option>
						<option value="MN">MN - Minnesota</option>
						<option value="MS">MS - Mississippi</option>
						<option value="MO">MO - Missouri</option>
						<option value="MT">MT - Montana</option>
						<option value="NE">NE - Nebraska</option>
						<option value="NV">NV - Nevada</option>
						<option value="NH">NH - New Hampshire</option>
						<option value="NJ">NJ - New Jersey</option>
						<option value="NM">NM - New Mexico</option>
						<option value="NY">NY - New York</option>
						<option value="NC">NC - North Carolina</option>
						<option value="ND">ND - North Dakota</option>
						<option value="OH">OH - Ohio</option>
						<option value="OK">OK - Oklahoma</option>
						<option value="OR">OR - Oregon</option>
						<option value="PA">PA - Pennsylvania</option>
						<option value="RI">RI - Rhode Island</option>
						<option value="SC">SC - South Carolina</option>
						<option value="SD">SD - South Dakota</option>
						<option value="TN">TN - Tennessee</option>
						<option value="TX">TX - Texas</option>
						<option value="UT">UT - Utah</option>
						<option value="VT">VT - Vermont</option>
						<option value="VA">VA - Virginia</option>
						<option value="WA">WA - Washington</option>
						<option value="WV">WV - West Virginia</option>
						<option value="WI">WI - Wisconsin</option>
						<option value="WY">WY - Wyoming</option>
					</select></td></tr>
				<tr><td align="right"><label>Zip</label></td>
					<td><input type="text" name="zip" /></td></tr></table>
				<input type="submit" name="submit_profile" value="SUBMIT">
			</form>
		');
	}
	
	function recreate_form()
	{
		print(' 
			<h3>Fill out the following information to create a user profile.</h3>
			<form name="login" method="post" action="">
				<table border=0><tr><td align="right"><label>Username</label></td>
					<td><input type="text" name="username" value="'. $_POST["username"] . '"/>'. test_valid($_POST["username"]) .'</td></tr>
				<tr><td align="right"><label>Password</label></td>
					<td><input type="password" name="password" value="'. $_POST["password"] . '"/>'. test_valid($_POST["password"]) .'</td></tr>
				<tr><td align="right"><label>Email Address</label></td>
					<td><input type="text" name="email" value="'. $_POST["email"] . '"/>'. test_valid($_POST["email"]) .'</td></tr></table>
				
				<h3>Shipping Information</h3>
				<table border = 0><tr><td align="right"><label>First Name</label></td>
					<td><input type="text" name="fname" value="'. $_POST["fname"] . '"/>'. test_valid($_POST["fname"]) .'</td></tr>
				<tr><td align="right"><label>Last Name</label></td>
					<td><input type="text" name="lname" value="'. $_POST["lname"] . '"/>'. test_valid($_POST["lname"]) .'</td></tr>
				<tr><td align="right"><label>Street Address</label></td>
					<td><input type="text" name="street" value="'. $_POST["street"] . '"/>'. test_valid($_POST["street"]) .'</td></tr>
				<tr><td align="right"><label>City</label></td>
					<td><input type="text" name="city" value="'. $_POST["city"] . '"/>'. test_valid($_POST["city"]) .'</td></tr>
				<tr><td align="right"><label>State</label></td>
					<td><select name="state">
						<option value="0">Select one...</option>
						<option value="AL">AL - Alabama</option>
						<option value="AK">AK - Alaska</option>
						<option value="AZ">AZ - Arizona</option>
						<option value="AR">AR - Arkansas</option>
						<option value="CA">CA - California</option>
						<option value="CO">CO - Colorado</option>
						<option value="CT">CT - Connecticut</option>
						<option value="DE">DE - Delaware</option>
						<option value="DC">DC - District of Columbia</option>
						<option value="FL">FL - Florida</option>
						<option value="GA">GA - Georgia</option>
						<option value="HI">HI - Hawaii</option>
						<option value="ID">ID - Idaho</option>
						<option value="IL">IL - Illinois</option>
						<option value="IN">IN - Indiana</option>
						<option value="IA">IA - Iowa</option>
						<option value="KS">KS - Kansas</option>
						<option value="KY">KY - Kentucky</option>
						<option value="LA">LA - Lousiana</option>
						<option value="ME">ME - Maine</option>
						<option value="MD">MD - Maryland</option>
						<option value="MA">MA - Massachusetts</option>
						<option value="MI">MI - Michigan</option>
						<option value="MN">MN - Minnesota</option>
						<option value="MS">MS - Mississippi</option>
						<option value="MO">MO - Missouri</option>
						<option value="MT">MT - Montana</option>
						<option value="NE">NE - Nebraska</option>
						<option value="NV">NV - Nevada</option>
						<option value="NH">NH - New Hampshire</option>
						<option value="NJ">NJ - New Jersey</option>
						<option value="NM">NM - New Mexico</option>
						<option value="NY">NY - New York</option>
						<option value="NC">NC - North Carolina</option>
						<option value="ND">ND - North Dakota</option>
						<option value="OH">OH - Ohio</option>
						<option value="OK">OK - Oklahoma</option>
						<option value="OR">OR - Oregon</option>
						<option value="PA">PA - Pennsylvania</option>
						<option value="RI">RI - Rhode Island</option>
						<option value="SC">SC - South Carolina</option>
						<option value="SD">SD - South Dakota</option>
						<option value="TN">TN - Tennessee</option>
						<option value="TX">TX - Texas</option>
						<option value="UT">UT - Utah</option>
						<option value="VT">VT - Vermont</option>
						<option value="VA">VA - Virginia</option>
						<option value="WA">WA - Washington</option>
						<option value="WV">WV - West Virginia</option>
						<option value="WI">WI - Wisconsin</option>
						<option value="WY">WY - Wyoming</option>
					</select>'. test_valid($_POST["state"]) .'</td></tr>
				<tr><td align="right"><label>Zip</label></td>
					<td><input type="text" name="zip" value="'. $_POST["zip"] . '"/>'. test_valid($_POST["zip"]) .'</td></tr></table>
				<input type="submit" name="submit_profile" value="SUBMIT">
			</form>
		');
	}
?>

			

<?php
	if(isset($_POST['submit_profile']))
	{
		if (test_invalid($_POST) == true)
		{
			recreate_form();
			print ("<br />Click <a href='project3.php'>here</a> to go back to the login page.");
		}
		else //test to see if the username is already taken
		{
			$select_query = "SELECT * FROM a3users";
    		$result = mysql_query($select_query) or die ("select failed");
			while($row = mysql_fetch_assoc($result))
			{
				if($row['user'] == $_POST['username'])
				{
					$user_test = 1;
				}
			}
			
			if($user_test == 1)
			{
				print("Username is already taken, please choose another.");
				recreate_form();
				print ("<br />Click <a href='project3.php'>here</a> to go back to the login page.");
			}
			else
			{
				$insert_user = "INSERT INTO a3users(user, password) VALUES ('".$_POST['username']."', '".md5($_POST['password'])."')";
				$user_result = mysql_query($insert_user);
				
				$select_query = "SELECT uid FROM a3users WHERE user = '".$_POST['username']."'";
				$select_result = mysql_query($select_query);
				$uid = mysql_fetch_assoc($select_result);
				
				$insert_info = "INSERT INTO a3user_info(uid, first_name, last_name, email, street, city, state, zip) VALUES ('".$uid['uid']."', '".$_POST['fname']."', '".$_POST['lname']."', '".$_POST['email']."', '".$_POST['street']."', '".$_POST['city']."', '".$_POST['state']."', '".$_POST['zip']."')";
				$info_result = mysql_query($insert_info);
				print("Successfully created a profile!<br />");	
				print ("Click <a href='project3.php'>here</a> to log in and begin shopping!");
			}
		}
	}
	else
	{
		create_form();
		print ("<br />Click <a href='project3.php'>here</a> to go back to the login page.");
	}
	
	mysql_close($connect);
?>
</center>
</body>
</html>

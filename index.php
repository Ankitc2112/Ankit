<?php include_once("config.php");?>
<?php
if(isset($_COOKIE['userid']))
{
	session_start();
	$_SESSION['userid']=$_COOKIE['userid'];
	if($_COOKIE['userid']=='ADMIN')
	{
		header("location:admin.php");
	}
	else if(substr($_COOKIE['userid'],0,2)=='DB')
	{
		header("location:Deliveryboy/index.php");
	}
	else if(substr($_COOKIE['userid'],0,2)=='SE')
	{
		header("location:Seller/index.php");
	}
	else if(substr($_COOKIE['userid'],0,2)=='SH')
	{
		header("location:Shop/index.php");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>COSP Home</title>
<link rel="icon" href="images/icons/c.png" size="20*20" />
<link rel="stylesheet" href="Style.css" type="text/css" />
<link rel="stylesheet" href="jquery_bootstrap\jquery_ui_css.css">
<link rel="stylesheet" href="jquery_bootstrap\bootstrap.css">
<script type="text/javascript" src="jquery_bootstrap\bootstrap.js"></script>
<script type="text/javascript" src="jquery_bootstrap\jquery.js"></script>
<script type="text/javascript" src="jquery_bootstrap\jquery_ui.js"></script>

<style>
#r{
	color:navy;
	font-family:Comic Sans MS;
	text-shadow:1px 1px 10px red;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
	$('#header').click(function(){
		$( '#dialog' ).attr('title','About COSP').dialog({
			buttons:{
				"OK":function(){
					$(this).dialog('close');
					
			}
			},
			closeOnEscape:false,
			width:'50%',
			resizable: false,
			modal: true,
			show:'fade'
				});		
	});
});
</script>
</head>
<body>

<center><div id="header">
<b>Welcome To Collections Of Sales Point</b>
</div></center>
<!--About COSP Dialog -->
<div id="dialog" style="display:none;">
<center><font size='5' color="red">Collection Of Sales Point</font><hr /></center>
<font size="2">This Is The Website which can be use by: <br />
<dl>
	<dt><b>Shop:</b></dt>
	<dd>Shop Can use this website to manage their shop online. The transaction like sales, purchase, inventory, reports can be made using this my site.</dd>
	<dt><b>Seller:</b></dt>
	<dd>Seller can list their product on this website which they have made in their hime and shop can buy those products.</dd>
	<dt><b>Delivery Boy</b></dt>
	<dd>Delivery boy have to deliver products from seller to shop, against which they will get delivery amount.</dd>
</dl>
</font>

<hr color="green">
<center>
<font size='5' color="blue">About Developer</font> <hr color='green' width='50%' />
<img src='images/ankit.jpg' width="100" height="100" /><br />
<font color="orange">Developer:Ankit Chaudhary <br />
Contact:+91-9910581600 <br />
IMR, Ghaziabad <br />
<a href="https://www.facebook.com/ankit.chaudhary.1232"><img src='images/icons/minif.png' width="30" height="30" /></a>
<a href="https://www.twitter.com/Ankit_MDB"><img src='images/icons/minit.png' /></a>
<a href="mailto:rc944435@gmail.com?subject=Feedback&body=Message"><img src='images/contact.png' width="30" height="30"/></a>
<br />
</center>
</font>
</div>
<br /><br />
<table width="30%" height="75%" align="center" >
	<tr>
		<td style="width:40%;text-align:center;line-height:200%;border:5px groove silver;border-radius:10%;">
				<font size="5" color="#330099">Login.</font><hr />
			<form action="index.php" method="post" align="center">
				Types Of User <br />
				<select name="usertype" id="field" style="padding-left:5%;padding-right:20%;">
					<option value="Admin">Admin</option>
					<option value="Shop">Shop</option>
					<option value="Seller">Seller</option>
					<option value="Delivery Boy">Delivery Boy</option>
				</select><br />
				User <br />
				<input type="text" name="userid" placeholder="Your Registerd Id" required minlength="5" maxlength="8" autocomplete='off' id="field" size="13"/> <br />
				Password<br />
				<input type="password" name="password" id="field" required minlength="5" maxlength="15" size="13"/><br />
				<br />
				<input type="submit" name="submit" value="Submit" id="btn" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="reset" name="reset" value="Clear" id="btn"/>
				<br />
				<span id='r'><a href="registrations/register.php">I'm New Here</a></span>
				<br />
				<span id="r"><a href="registrations/forgetpassword.php">Forget UserID/Password</a></span><br />
				<span id="r"><a href="registrations/pyamt.php">Payments</a></span>
		
		
		</td>
	</tr>
</table>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
$type=$_POST['usertype'];
$userid=$_POST["userid"];
$password=hash("ripemd256",crypt($_POST["password"],"cospkey"));


$sql="SELECT * FROM users WHERE userid='$userid' and password='$password' AND usertype='$type' AND status='Active'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
if($count>=1)
{
$lastlogin=mysql_query("Update users SET lastlogin=now() where userid='$userid';");
session_start();
$_SESSION['userid']=$userid;

setcookie("userid",strtoupper($userid), time()+43200,"/","",0);
setcookie("pass",$password, time()+43200,"/");

	if($type=="Admin"){
		
	header("location:admin.php");
	}
	else if($type=='Seller')
	{
		header("location:Seller/index.php");
	}
	else if($type=="Delivery Boy")
	{
		header("location:Deliveryboy/index.php");
	}
	else if($type=="Shop")
	{
		header("location:Shop/index.php");
	}
}
else {
	echo "<h4 align='center'><font color='red'>You Have Entered Wrong User ID or Password..</font></h4>";
}
}
?>
<br /><br /><br />
<hr /><center>&copy;2017@ Ankit Chaudhary All Right Reserve</center>
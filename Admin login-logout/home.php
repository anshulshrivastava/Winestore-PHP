<?php
include('conn.php');
session_start();
if (!isset($_SESSION['member_id'])){
header('location:index.php');
}
//
?>
<head>

</br>
</br>
<style> .btn-custom {
  background-color: hsl(195, 60%, 35%) !important;
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#2d95b7", endColorstr="#23748e");
  background-image: -khtml-gradient(linear, left top, left bottom, from(#2d95b7), to(#23748e));
  background-image: -moz-linear-gradient(top, #2d95b7, #23748e);
  background-image: -ms-linear-gradient(top, #2d95b7, #23748e);
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #2d95b7), color-stop(100%, #23748e));
  background-image: -webkit-linear-gradient(top, #2d95b7, #23748e);
  background-image: -o-linear-gradient(top, #2d95b7, #23748e);
  background-image: linear-gradient(#2d95b7, #23748e);
  border-color: #23748e #23748e hsl(195, 60%, 32.5%);
  color: #fff !important;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.16);
  -webkit-font-smoothing: antialiased;
} </style>



</head>
<body>
 <a href="http://cs1.bradley.edu/~smarri/index.html">Click Here To Go To Home Page</a>
</body>
<?php
//mag show sang information sang user nga nag login
$member_id=$_SESSION['member_id'];

$result=mysql_query("select * from members where member_id='$member_id'")or die(mysql_error);
$row=mysql_fetch_array($result);



$FirstName=$row['FirstName'];
$LastName=$row['LastName'];


echo "<h2><font color=\"grey\">Welcome...$FirstName $LastName <Admin></font></h2>";
//echo "<h2><font color=\"grey\">$FirstName</font></h2> <h2><font color=\"white\">$LastName</font></h2>";
//ss
?>

<div align="left">
<form>
<br><h2><font color="#66FFFF"Choose Options To perform Operations -</font></h2><br>
<div class="indent"><button><a href="http://cs2.bradley.edu/~ashrivastava2/insert.html">Insert Into Winsestore</a></button></div>
<br>
<div class="indent"><button ><a href="http://cs2.bradley.edu/~ashrivastava2/update.html">Update From Winsestore</a></button></div>
<br>
<div class="indent"><button ><a href="http://cs2.bradley.edu/~ashrivastava2/delete.html">Delete From Winsestore</a></button></div>


</form>
</div>


<div align="justify">
<a href="logout.php"><h2><font color="red">Sign Out</font></h2></a>
</div>

</body>
</html>
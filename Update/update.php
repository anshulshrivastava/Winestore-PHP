<a href="http://cs2.bradley.edu/~ashrivastava2/update.html">Click Here To Update More Data</a>
<?php
session_start();
if (!isset($_SESSION['member_id'])){
header('location:index.php');
}

?>

<html>
<head>
 <a href="http://cs1.bradley.edu/~smarri/index.html">Click Here To Go To Home Page</a>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WineStar Club</title>
</head>
<body>

<?php
require "../../Finals/Update/database.inc";
require_once "../../Finals/Update/HTML/Template/ITX.php";
function displayWinesList($connection,$query)
  {
     
     if (!($result = @ mysql_query ($query, $connection)))
        showerror();

   
     $rowsFound = @ mysql_num_rows($result);

     
     if ($rowsFound > 0)
     {
         
         print "<table border=\"2\">";
               print "\n\t<th>Winery_ID</th>";
	       print "\n\t<th>Winery_Name</th>";
              print "\n\t<th>Region_ID</th>\n</tr>";

        
         while ($row = @ mysql_fetch_array($result))
         {
            
            print "\n<tr>\n\t<td>{$row["winery_id"]}</td>" .
                  "\n\t<td>{$row["winery_name"]}</td>" .
                  "\n\t<td>{$row["region_id"]}</td>\n</tr>";
         } 
         print "\n</table>";
     } 

     
     print "{$rowsFound} records found matching your criteria<br>";
  } 

try{
if (!empty($_GET["winery_id"]) &&
    !empty($_GET["winery_name"]) &&
    !empty($_GET["region_id"])) {
     if (!($connection = @ mysql_connect($hostName, $username, $password)))
     throw new Exception("Could not connect to database");
     $winery_id = mysqlclean($_GET, "winery_id", 50, $connection); 
	 $winery_name = mysqlclean($_GET, "winery_name", 50, $connection);
	 $region_id = mysqlclean($_GET, "region_id", 20, $connection);
	
	 
   if (!mysql_select_db($databaseName, $connection))
     throw new Exception("Unable to open Database....");
	 
	
  
	$query = "UPDATE winery SET winery_id = '{$winery_id}', winery_name = '{$winery_name}', region_id = '{$region_id}' WHERE winery_id = {$winery_id}";

   
    if (!(@ mysql_query ($query, $connection)))
        throw new Exception("Unable to execute query...");
    
     $query = "SELECT * FROM winery";
	 displayWinesList($connection, $query);
}
else {
  
 throw new Exception("Wine details are not entered properly.....");
header("Location: http://cs2.bradley.edu/~ashrivastava2/update.html");
}
}catch(Exception $e)
       {
         echo 'Message: ' .$e->getMessage();
       }
?>
<br />
<a href="http://cs2.bradley.edu/~ashrivastava2/update.html"><storng>Back to Update Page</storng></a>
<br />

</body>
</html>
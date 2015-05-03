
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <a href="http://cs2.bradley.edu/~ashrivastava2/delete.html">Click Here To Delete More Data</a>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Winestore Deletion</title>

</head>

<body>

<?php
require "database.inc";
require_once "HTML/Template/ITX.php";
function displayWinesList($connection,$query)
  {
    
     if (!($result = @ mysql_query ($query, $connection)))
        showerror();

     
     $rowsFound = @ mysql_num_rows($result);

     
     if ($rowsFound > 0)
     {
      

       
         print "<table border=\"2\">";
               print "\n\t<th>wine_id</th>";
	       print "\n\t<th>inventory_id</th>";
              print "\n\t<th>cost</th>\n</tr>";

      
         while ($row = @ mysql_fetch_array($result))
         {
            
            print "\n<tr>\n\t<td>{$row["wine_id"]}</td>" .
                  "\n\t<td>{$row["inventory_id"]}</td>" .
                  "\n\t<td>{$row["cost"]}</td>\n</tr>";
         } 

        
         print "\n</table>";
     }

    
     print "{$rowsFound} records found matching your criteria<br>";
  } 


try{

if (!empty($_GET["wine_id"]) ) {
     if (!($connection = @ mysql_connect($hostName, $username, $password)))
     throw new Exception("Could not connect to database");
     $wine_id = mysqlclean($_GET, "wine_id", 50, $connection); 
	
	 
   if (!mysql_select_db($databaseName, $connection))
     throw new Exception("Could not open Database....");
    
		$query = "DELETE from inventory WHERE wine_id = {$wine_id}";


    if (!(@ mysql_query ($query, $connection)))
        throw new Exception("Unable to execute query...");
		
  
     $query = "SELECT * FROM inventory";
	 displayWinesList($connection, $query);
}
else {

 throw new Exception("Wine details are not entered properly.....");
header("Location: http://cs2.bradley.edu/~ashrivastava2/delete.html");
}
}
catch(Exception $e)
       {
         echo 'Message: ' .$e->getMessage();
       }
?>

</body>
</html>
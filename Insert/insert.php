 <a href="http://cs2.bradley.edu/~ashrivastava2/insert.html">Click Here To Insert More Data</a>
<?php
require "database.inc";
require_once "HTML/Template/ITX.php";
function displayWinesList($connection,$query)
  {
     $subject = 'Insertion Information' ;

    
     // Run the query on the server
     if (!($result = @ mysql_query ($query, $connection)))
        showerror();

     // Find out how many rows are available
     $rowsFound = @ mysql_num_rows($result);

     // If the query has results ...
     if ($rowsFound > 0)
     {
         // ... print out a header
         //print "Wines  of $regionName<br>";

         // and start a <table>.
         print "<table border=\"2\">";
		   print "\n\t<th>Winery_ID</th>";
			 
	       print "\n\t<th>Winery_Name</th>";
		   
              print "\n\t<th>Region_ID</th>\n</tr>";
			  

         // Fetch each of the query rows
         while ($row = @ mysql_fetch_array($result))
         {
            // Print one row of results
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
     die("Could not connect");
     $winery_id = mysqlclean($_GET, "winery_id", 50, $connection); 
	 $winery_name = mysqlclean($_GET, "winery_name", 50, $connection);
	 $region_id = mysqlclean($_GET, "region_id", 20, $connection);
	
	 
   if (!mysql_select_db($databaseName, $connection))
     showerror();
    
   
    $query = "INSERT INTO winery VALUES('{$winery_id}', '{$winery_name}', '{$region_id}')";  
   
    if (!(@ mysql_query ($query, $connection)))
        showerror();
   
	
  
  echo "Thank you for using our mail form";
     $query = "SELECT * FROM winery";
	 displayWinesList($connection, $query);
}
else {
 
 throw new Exception("Wine details are not entered properly.....");
header("insert.html");
}
}
catch(Exception $e)
       {
         echo 'Message: ' .$e->getMessage();
       }
?>



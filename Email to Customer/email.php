<html>

 <a href="http://cs1.bradley.edu/~smarri/index.html">Click Here To Go To Home Page</a>
<head>

<title>WineStar Club</title>

<style type = "text/css">
body{ font-family: sans-serif;
	  background-color: white; 
	}
table{ background-color: #99C68E;
		border-collapse: collapse;
		border:1px solid #99C68E; 
	}
td { padding: 5px;}
tr:nth-child(odd){
background-color: white;}
</style>


</head>

<body background="image3.jpg">
<div align="left">
<br>
<h3>The Email Send Successfully...!!</h3>

</div>
<?php
require "database.inc";
require_once "HTML/Template/ITX.php";



			function displayWinesList($connection,$query,$email_id)
  {
     $subject = 'Wine Details' ;
  $output = 'Thank you for Connecting with us.' ;
    
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
         print "<table border=\"2\" align=\"left\">";
		 $output = '<h3>Wines list </h3>';
		 $output .= '<table border=\"2\" >';
               print "\n\t<th>Winery_ID</th>";
			   $output .= '<th>Winery_ID</th>';
	       print "\n\t<th>Winery_Name</th>";
		   $output .= '<th>Winery_Name</th>';
		   
		    
			 print "\n\t<th>Wine_Name</th>";
		   $output .= '<th>Wine_Name</th>';
		   
			
              print "\n\t<th>Region_ID</th>\n</tr>";
			  $output .= '<th>Region_ID</th></tr>';

         // Fetch each of the query rows
         while ($row = @ mysql_fetch_array($result))
         {
            // Print one row of results
            print "\n<tr>\n\t<td>{$row["winery_id"]}</td>" .
                  "\n\t<td>{$row["winery_name"]}</td>" .
				  "\n\t<td>{$row["wine_name"]}</td>" .
                  "\n\t<td>{$row["region_id"]}</td>\n</tr>";
				  $output .= '<tr><td>';
				  $output .= $row["winery_id"];
				  $output .= '</td>';
				  $output .= '<td>';
				  $output .= $row["winery_name"];
				  $output .= '</td>';
				   $output .= '<td>';
				  $output .= $row["wine_name"];
				  $output .= '</td>';
				  $output .= '<td>';
				  $output .= $row["region_id"];
				  $output .= '</td></tr>';
				  
         } // end while loop body

         // Finish the <table>
         print "\n</table>";
		 $output .= '</table>';
     } // end if $rowsFound body
	 $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ashrivastava2@mail.bradley.edu' . "\r\n";
    mail($email_id, $subject,
  $output, $headers);
     // Report how many rows were found
     print "{$rowsFound} records found matching your criteria<br>";
  } // end of function












//require_once "../AppData/Local/Temp/Rar$DI19.415/HTML/Template/ITX.php";
// Test for user input
if (!empty($_GET["email_id"])) {
     if (!($connection = @ mysql_connect($hostName, $username, $password)))
     die("Could not connect");
     
	 $email_id = mysqlclean($_GET, "email_id", 50, $connection);
	 
   if (!mysql_select_db($databaseName, $connection))
     showerror();
    
     $query = "SELECT  wi.winery_id, wi.winery_name, wi.region_id, w.wine_name FROM winery wi, wine w WHERE w.winery_id = wi.winery_id";
	 displayWinesList($connection, $query,$email_id);
}
else {
 // Missing data: Go back to the 
header("sendemail.html");
}



?>
<br />

<br />

</body>
</html>
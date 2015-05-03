
<div align="left"><a href="http://cs1.bradley.edu/~smarri/index.html">Click Here to Back to Home Page</a></div>

<div align="center">
<h1>Search For Wines According To Region</h1>
</div>


<?php
 
   $connection = mysql_connect("cs2.bradley.edu","ashrivastava2","mqex1qos");   
  mysql_select_db("winestore_ashrivastava2", $connection);
  
  
  
  $dosearch = $_REQUEST["search"];
  $region = $_REQUEST["region"];
  $winetype = $_REQUEST["winetype"];
  
  $regionlist = mysql_query ("SELECT * FROM region", $connection);
  $winetypelist = mysql_query ("SELECT * FROM wine_type", $connection);
  
  if($dosearch == "true"){	   
	  $query1 = setupQuery($region,$winetype);
	  $newarrivals = mysql_query ($query1, $connection);
  
  }
  else
  {
  $newarrivals = mysql_query ("SELECT  wi.winery_name, w.year, w.wine_name, w.wine_id, 
                     w.description,i.cost
             FROM wine w, winery wi, inventory i
             WHERE w.winery_id = wi.winery_id
             AND w.wine_id = i.wine_id
             AND w.description IS NOT NULL
             GROUP BY w.wine_id
             ORDER BY i.date_added DESC LIMIT 4", $connection);
	}
	
	function setupQuery($region_name, $wine_type)
	{
	   // Show the wines stocked at the winestore that match
	   // the search criteria
	   $query = "SELECT DISTINCT wi.winery_name, 
						 w.year, 
						 w.wine_name, 
						 w.wine_id,
						 w.description,i.cost
				 FROM wine w, winery wi, inventory i, region r, wine_type wt
				 WHERE w.winery_id = wi.winery_id
				 AND w.wine_id = i.wine_id";
	
	   // Add region_name restriction if they've selected anything
	   // except "All"
	   if ($region_name != "All")
		  $query .= " AND r.region_name = '{$region_name}'
					  AND r.region_id = wi.region_id";
		  
	   // Add wine type restriction if they've selected anything
	   // except "All"
	   if ($wine_type != "All")
		  $query .= " AND wt.wine_type = '{$wine_type}'
					  AND wt.wine_type_id = w.wine_type";
	
	   // Add sorting criteria
	   $query .= " ORDER BY wi.winery_name, w.wine_name, w.year";
	
	   return ($query);
	}
  
 ?>

 
 
 

  <html>
  
  <head>
<style type = "text/css">
body{ font-family: sans-serif;
	  background-color: white; 
	}
table{ background-color: lightblue;
		border-collapse: collapse;
		border:1px solid gray; 
	}
td { padding: 5px;}
tr:nth-child(odd){
background-color: white;}
</style>
</head>
  
<body>  



		
		
				<form action="query.php" method="get">
                 
                 
                   Region:
                      <select name="region">
					  
					  
					  <?php
					   while ($row = mysql_fetch_array($regionlist))   {
					   $regionname = $row['region_name'];
					   print "<option value='$regionname'>$regionname</option>";
					   }
					  ?>
					  	  
                      </select>

                   
				   
				   Type:
                      <select name="winetype">
					  
					   <?php
					   while ($row = mysql_fetch_array($winetypelist))   {
					   $winetypename = $row['wine_type'];
					   print "<option value='$winetypename'>$winetypename</option>";
					   }
					  ?>
                      </select>
					  
                    </br>
                    </br>
                    <td><input type="hidden" name="search" value="true"/><input type="submit" name="Submit" value="Search" /></td>
                
					<?php
					if($dosearch == "true"){
					print "";
					}
					?>
					
   

		
	
	
		  <?php
		  if($dosearch == "true"){
		    print "";
		  }
		  else{
		  print "</br>";
		  }
		  ?>
     
	
    <?php
    	   print "<table width=\"834\"  height=\"23\"border=\"2\">";
		 $output = '<h3>Your Search Results </h3>';
		 $output .= '<table border=\"2\">';
              
			   print "\n\t<th width=\"104\">Wine</th>";
			   
			   $output .= '<th>Wine</th>';
	      
		   print "\n\t<th width=\"203\">Winery Name</th>";
		  
		   $output .= '<th w>Winery Name</th>';
            
			  print "\n\t<th width=\"99\">Year</th>";
			  
			  $output .= '<th>Year</th></tr>';
			  
			   print "\t<th width=\"247\">Description</th>";
			 
			  $output .= '<th>Description</th></tr>';
			 
			   print "\n\t<th>Cost</th>\n</tr>";
			 
			  $output .= '<th>Cost</th></tr>';
			  
		?>
			
			<?php
			
						
			
			echo "<b><div align=\"center\">Total number of results yielded:".mysql_num_rows($newarrivals)."</div>";
			
			while ($row = mysql_fetch_array($newarrivals))   
			{
				
			 print "\n<tr>\n\t<td align \"center\">{$row["wine_name"]}</td>" .
			        "\n\t<td align=\"center\" width=\"203\">{$row["winery_name"]}</td>" .
					 "\n\t<td>{$row["year"]}</td>" .
                  "\n\t<td align=\"center\">{$row["description"]}</td>" .
                  "\n\t<td align=\"center\">{$row["cost"]}</td>\n</tr>";
				  $output .= '<tr><td>';
				  $output .= $row["wine_name"];
				  $output .= '</td>';
				  $output .= '<td>';
				  $output .= $row["winery_name"];
				  $output .= '</td>';
				   $output .= '<td>';
				  $output .= $row["year"];
				  $output .= '</td>';
				   $output .= '<td>';
				  $output .= $row["description"];
				  $output .= '</td>';
				  $output .= '<td>';
				  $output .= $row["cost"];
				  $output .= '</td></tr>';
			}
			
			 print "\n</table>";
		 $output .= '</table>'
			?>
					
<?php


    $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ashrivastava2@mail.bradley.edu' . "\r\n";
	$to = "anshul.shrivastava09@gmail.com";
	$from = "ashrivastava2@mail.bradley.edu";
	 
 	if (mail($to, $from, $output, $headers )) {
   		echo("<p>The Following Search Successfully Send...!!</p>");
  	} else {
   		echo("<p>Message delivery");
	}
?>








</body></html>

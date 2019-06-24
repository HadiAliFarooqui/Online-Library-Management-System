
<html>
 <head>
  <title>Export MySQL data to Excel in PHP</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 </head>
 <body>
	<?php
$servername = "localhost";
$username = "root";
$password = "love_muhammed";
$dbname = "online";

 $conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
	<div class="container">
	<a href= "export.php?export=true">Export</a>
	<table>
	<tr>
		<th>Student ID</th>
		<th>Individual Fine</th>
		<th>Total fine</th>
    <th>Fine XYZ</th>
  </tr>
	<?php
		$data= array();
			$query= mysqli_query($conn, 'select * from f_details');
			while($row_item=mysqli_fetch_array($query)){
				$data=$row_item;
	?>
	<tr>
		<td><?php echo $row_item['StudentID']; ?></td>
		<td><?php echo $row_item['indiv_fine']; ?></td>


  </tr>
			<?php } ?>

	</table>
	</div>
<input id="clickMe" type="button" value="clickme" onclick="doFunction();" />
<script>
  function doFunction()
    {
        $sql = "INSERT into f_details(StudentID,indiv_fine)
        SELECT StudentID,SUM(fine) from tblissuedbookdetails GROUP BY StudentID";
    }
  </body>
	</html>

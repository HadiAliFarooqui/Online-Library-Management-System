<?php  
//export.php  
$connect = mysqli_connect("localhost", "root", "love_muhammed", "online");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM fine_details";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>StudentID</th>  
                         <th>Individual Fine</th>  
                         <th>Total Fine</th>  
       
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$row["StudentID"].'</td>  
                         <td>'.$row["indiv_fine"].'</td>  
                         <td>'.$row["total_fine"].'</td>
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}
?>

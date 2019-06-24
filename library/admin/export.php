
// Database Connection
<?php
$servername = "localhost";
$username = "root";
$password = "love_muhammed";
$dbname = "online";

 $conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_GET['export'])){
if($_GET['export'] == 'true'){
$query = mysqli_query($conn, 'select * from f_details'); // Get data from Database from demo table


    $delimiter = ",";
    $filename = "significant_" . date('Ymd') . ".csv"; // Create file name

    //create a file pointer
    $f = fopen('php://memory', 'w');

    //set column headers
    $fields = array('StudentID', 'indiv_fine', 'total_fine','fine_xyz');
    fputcsv($f, $fields, $delimiter);

    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){

        $lineData = array($row['StudentID'], $row['indiv_fine'], $row['total_fine'],$row['fine_xyz']);
        fputcsv($f, $lineData, $delimiter);
    }

    //move back to beginning of file
    fseek($f, 0);

    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer
    fpassthru($f);


 }
}

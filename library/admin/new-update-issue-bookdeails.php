<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['return']))
{
$rid=intval($_GET['rid']);
$fine=$_POST['fine'];
$rstatus=1;
$sql="update tblissuedbookdetails set fine=:fine,RetrunStatus=:rstatus where id=:rid";
$query = $dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->bindParam(':fine',$fine,PDO::PARAM_STR);
$query->bindParam(':rstatus',$rstatus,PDO::PARAM_STR);
$query->execute();

$_SESSION['msg']="Book Returned successfully";
header('location:manage-issued-books.php');



}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Issued Book Details</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script>
// function for get student name
function getstudent() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_student.php",
data:'studentid='+$("#studentid").val(),
type: "POST",
success:function(data){
$("#get_student_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

//function for book details
function getbook() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_book.php",
data:'bookid='+$("#bookid").val(),
type: "POST",
success:function(data){
$("#get_book_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

</script> 
<style type="text/css">
    fieldset
    {
      background-color:#00ffff;
      height:350px;
      width:950px;
	  padding: 20px;
      background: #FAFAFA;
      margin: 40px auto;
      box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
      border-radius: 10px;
      border: 6px solid #305A72;
    }
    h1,p
    {
      font-family:Trebuchet MS;
    }
    button
    {
	  border: none;
	  padding: 8px 15px 8px 15px;
	  background: #FF8500;
	  color: #fff;
	  box-shadow: 1px 1px 4px #DADADA;
	  -moz-box-shadow: 1px 1px 4px #DADADA;
	  -webkit-box-shadow: 1px 1px 4px #DADADA;
	  border-radius: 3px;
	  -webkit-border-radius: 3px;
	  -moz-border-radius: 3px;
		hover;
    }
  
  .others{
    color:red;
}

</style>


</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Issued Book Details</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1"">
<div class="panel panel-info">
<div class="panel-heading">
Issued Book Details
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$rid=intval($_GET['rid']);
$sql = "SELECT tblstudents.FullName,tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine,tblissuedbookdetails.RetrunStatus from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblissuedbookdetails.id=:rid";
$query = $dbh -> prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                   



<div class="form-group">
<label>Student Name :</label>
<?php echo htmlentities($result->FullName);?>
</div>

<div class="form-group">
<label>Book Name :</label>
<?php echo htmlentities($result->BookName);?>
</div>


<div class="form-group">
<label>ISBN :</label>
<?php echo htmlentities($result->ISBNNumber);?>
</div>

<div class="form-group">
<label>Book Issued Date :</label>
<?php echo htmlentities($result->IssuesDate);?>
</div>


<div class="form-group">
<label>Book Returned Date :</label>
<?php if($result->ReturnDate=="")
                                            {
                                                echo htmlentities("Not Return Yet");
                                            } else {


                                            echo htmlentities($result->ReturnDate);
}
                                            ?>
</div>

<div class="form-group">
<label>Fine (in Rs) :</label>
<?php 
if($result->fine=="")
{?>
<input class="form-control" type="text" name="fine" id="fine"  required />

<?php }else {
echo htmlentities($result->fine);
}
?>









 <?php if($result->RetrunStatus==0){?>

<button type="submit" name="return" id="submit" class="btn btn-info">Return Book </button>

 </div>

<?php }}} ?>
                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
	
	<!-- fine form-->
	

<script>
  const setup = () => {
    let firstDate = $('#firstDate').val();
    let secondDate = $('#secondDate').val();

    const findTheDifferenceBetweenTwoDates = (firstDate, secondDate) => {
      firstDate = new Date(firstDate);
      secondDate = new Date(secondDate);

      let timeDifference = Math.abs(secondDate.getTime() - firstDate.getTime());

      let millisecondsInADay = (1000 * 3600 * 24);

      let differenceOfDays = Math.ceil(timeDifference / millisecondsInADay);

      let fine=1;
      if(differenceOfDays==0)
        fine=0;
      else
        fine=differenceOfDays*2

      return ["The no of days are "+ differenceOfDays , "The fine is Rs."+fine];

    }

    let result = findTheDifferenceBetweenTwoDates(firstDate, secondDate);
    alert(result);
    $("#result").text(result);

  }

  $(document).ready(function () {
  $('#submit').click(function () {
    setup();
  })
  });
</script>
<div class="container">
    <h3><center>Fine Calculation</center></h3>
    <fieldset>
        <h4>First Date</h4>
          <input id="firstDate" type ="text">
        <br/>
         <h4>Second Date</h4>
          <input id="secondDate" type ="text">
        <br>
        <p>Number of Days and Fine</p>
        <p><span id="result"></span></p>
        <button id="submit">Submit</button>
    </fieldset>
</div>



     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
	
	
	
	

</body>
</html>
<?php } ?>

<?php
 require 'conn.php';
 echo $_GET['QDate'];
 echo $_GET['QNumber'];
 $sql = "DELETE FROM queue WHERE QDate=:QDate and QNumber=:QNumber";
 $stmt = $conn->prepare($sql);
 $stmt->bindParam(":QDate",$_GET["QDate"]);
 $stmt->bindParam(":QNumber",$_GET["QNumber"]);
 //  $stmt->execute();

 echo '
 <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

if ($stmt->execute()) {
 echo '
 <script type="text/javascript">
 
 $(document).ready(function(){
 
     swal({
         title: "Success!",
         text: "Successfuly update customer information",
         type: "success",
         timer: 2500,
         showConfirmButton: false
       }, function(){
             window.location.href = "index.php";
       });
 });
 
 </script>
 ';
}
$conn = null;
?>
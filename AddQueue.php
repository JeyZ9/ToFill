<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <style type="text/css">
        img {
            transition: transform 0.25s ease;
        }

        img:hover {
            -webkit-transform: scale(1.5);
            transform: scale(1.5);
        }
    </style>


</head>

<body>
    <?php
    require 'conn.php';

    if (isset($_POST['submit'])) {
        if (!empty($_POST['QDate']) && !empty($_POST['Pid'])) {
            echo "Test = ". $_POST['QDate'];
            echo "Test = ". $_POST['QNumber'];
            echo "Test = ". $_POST['Pid'];
            $QStatus = "รอเข้ารับการรักษา";

            $sql = "INSERT INTO queue values (:QDate, :QNumber, :Pid, :QStatus)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':QDate', $_POST['QDate']);
            $stmt->bindParam(':QNumber', $_POST['QNumber']);
            $stmt->bindParam(':Pid', $_POST['Pid']);
            $stmt->bindParam(':QStatus', $QStatus);

            echo '
                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

            try {
                if ($stmt->execute()) :
                    echo '
                        <script type="text/javascript">        
                        $(document).ready(function(){
                    
                            swal({
                                title: "Success!",
                                text: "Successfuly add customer",
                                type: "success",
                                timer: 2500,
                                showConfirmButton: false
                            }, function(){
                                    window.location.href = "index.php";
                            });
                        });                    
                        </script>
                    ';
                else :
                    $message = 'Fail to add new Queue';
                endif;
            } catch (PDOException $e) {
                echo 'Fail! ' . $e;
            }
            $conn = null;
        }else{
            echo "if ผิดพลาด";
        }
    }
    ?>




    <div class="container">
        <div class="row">
            <div class="col-md-4"> <br>
                <h3>ฟอร์มเพิ่มข้อมูลคิว</h3>
                <br><br>
                <form action="AddQueue.php" method="POST">
                    <input type="date" placeholder="วันที่" name="QDate" class="form-control" required>
                    <br>
                    <input type="number" placeholder="หมายเลขคิว" name="QNumber" class="form-control" required>
                    <br>
                    <input type="text" placeholder="รหัสบัตรประชาชน" class="form-control" name="Pid">
                    <br>
                    <!-- <input type="submit" value="รอเข้ารับการรักษา
" name="QSatus" class="btn btn-primary" /> -->
                    <input type="submit" value="Submit" name="submit" class="btn btn-primary" />
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#customerTable').DataTable();
        });
    </script>



</body>

</html>
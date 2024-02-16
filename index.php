<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12"> <br>
                <h3>CRUD ข้อมูลการจองคิวสำหรับ จนท.เท่านั้น!!! <a href="AddQueue.php" class="btn btn-info float-end">+เพิ่มข้อมูลการจองคิว</a>
                </h3> <br />
                <table id="PatientTable" class="display table table-striped  table-hover table-responsive table-bordered ">

                    <thead align="center">
                        <tr>
                            <th width="10%">วันที่จองเข้ารับการรักษา</th>
                            <th width="10%">รหัสคิว</th>
                            <th width="25%">ชื่อ - นามสกุล</th>
                            <th width="10%">เพศ</th>
                            <th width="10%">ภาพผู้ป่วย</th>
                            <th width="15%">สถานะคิว</th>
                            <th width="5%">แก้ไข</th>
                            <th width="5%">ลบ</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        require 'conn.php';
                        $query =
                            'SELECT * FROM queue inner JOIN patient ON patient.Pid = queue.Pid
                            inner join gender ON gender.genderID = patient.Pgender';
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->fetchAll();

                        foreach ($result as $r) { ?>
                            <tr>
                                <td>
                                    <?= $r['QDate'] ?>
                                </td>
                                <td>
                                    <?= $r['QNumber'] ?>
                                </td>
                                <td>
                                    <?= $r['Pname'] ?>
                                </td>
                                <td>
                                    <?= $r['genderDescription'] ?>
                                </td>
                                <td><img src="./picture/<?= $r['Image'] ?>" width="50px" height="50" alt="image" onclick="enlargeImg()" id="img1"></td>
                                <td>
                                    <?= $r['QStatus'] ?>
                                </td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="UpdateQueueForm.php?QDate=<?= $r['QDate']?>&&QNumber=<?= $r['QNumber']?>">แก้ไข</a>
                                </td>
                                <td>
                                    <a class='btn btn-danger btn-sm' href="DeleteQueue.php?QDate=<?= $r['QDate']?>&&QNumber=<?= $r['QNumber']?>">ลบ</a>
                                </td>

                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#PatientTable').DataTable();
        });
    </script>
</body>

</html>
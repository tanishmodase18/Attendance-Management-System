<?php include_once("connection.php"); ?>
<?php
    if (isset($_GET['down_date']))
    {
        $downdate = $_GET['down_date'];
        $filename = "attendance_"."$downdate".".csv";
        $fp = fopen('php://output', 'w');

        $header = array('Attendance_Id', 'PRN', 'Name', 'Email', 'Status');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        fputcsv($fp, $header);

        $query = "select a.attend_id, a.PRN, concat(s.first_name, ' ', s.last_name), s.email_id, a.value from attendance a, student s where a.PRN = s.PRN and a.date='$downdate'";
        $result = $link->query($query);
        while ($row = $result->fetch_assoc())
        {
            fputcsv($fp, $row);
        }
    exit();
    }
?>
<!DOCTYPE html>

<html>

<head>
    <title>Attendance Management System</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.min.css">
    <script src="bootstrap/bootstrap.min.js"></script>
    <script src="bootstrap/jquery.min.js"></script>
</head>

<body style="padding-top:20px">
    <div style="padding-top:10px; padding-bottom:10px" class="panel panel-default container">
        <div class="panel-heading">
            <h1 style="text-align:center">Attendance Management System</h1>
        </div>
        <div class="panel-body">
            <a href="view.php" class="btn btn-primary pull-right">Back</a>
            <a href="?down_date=<?php echo $_GET['date'] ?>" class="btn btn-primary pull-right" style="background-color:green;margin-right:5px">Download</a>
            <a style="color:black; text-align:left; padding-top:5px" class="pull-left">Date: <?php echo $_GET['date'] ?></a>
            <form method="post">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="padding-top:10px">Attendance_id</th>
                            <th>PRN</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <?php
                    $dat = $_GET['date'];
                    $query = "select a.attend_id, a.PRN, s.first_name, s.last_name, s.email_id, a.value from attendance a, student s where a.PRN = s.PRN and a.date='$dat'";
                    $result = $link->query($query);
                    if ($result->num_rows > 0) {
                        while ($arr = $result->fetch_assoc()) {
                    ?>

                            <tr>
                                <td><?php echo $arr['attend_id']; ?></td>
                                <td><?php echo $arr['PRN']; ?></td>
                                <td><?php echo $arr['first_name'] . " " . $arr['last_name']; ?></td>
                                <td><?php echo $arr['email_id']; ?></td>
                                <td><?php echo $arr['value']; ?></td>
                            </tr>
                    <?php }
                    } ?>
                </table>
            </form>
        </div>
        <div class="panel-footer"></div>

    </div>
    <div>
        <p style="position:absolute;bottom:0;margin-left:605px">copyright by group14 @<?php echo date('Y'); ?></p>
    </div>
</body>

</html>
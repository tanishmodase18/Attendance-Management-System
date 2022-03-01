<?php include_once("connection.php"); ?>

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
                <a href="index.php" class="btn btn-primary pull-right">Back</a>
                <form method="post">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="padding-top:10px">Sr. No.</th>
                                <th>Date</th>
                                <th>View</th>
                            </tr>
                        </thead>

                        <?php
                            $query = "select distinct date from attendance";
                            $result = $link->query($query);
                            if($result->num_rows>0)
                            {
                                $i=0;
                                while($val = $result->fetch_assoc())
                                {
                                    $i++;
                        ?>
                        
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $val['date']; ?></td>
                            <td>
                                <a href="viewatt.php?date=<?php echo $val['date'] ?>" class="btn btn-primary"> View </a>
                            </td>
                        </tr>

                        <?php } } ?>
                    </table>
                </form>
            </div>
            <div class="panel-footer"></div>

        </div>
        <div><p style="position:absolute;bottom:0;margin-left:605px">copyright by group14 @<?php echo date('Y'); ?></p></div>
    </body>
</html>
<!DOCTYPE html>
<html ng-app="myApp" ng-app lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        ul>li, a{cursor: pointer;}
    </style>
    <title>Creating a Simple RESTful PHP web service which is consumed by a AngularJS application</title>
</head>
<body>

<br/>
<h1 align="center">Automation Test Result</h1>
<div align="center">
<table >
<thead>
<th>WebUI&nbsp;</th>
<th>Rest API&nbsp;</th>
<th>Action&nbsp;</th>
<th>CLI&nbsp;</th>
</thead>
<tbody>
</tbody>
</table>
</div>
<p align="center">------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
<style type="text/css">
    * {
        margin:0;
        padding:0;
    }
    table {
        font-family:Verdana, Arial, Helvetica, sans-serif;
        font-size:11px;
        margin:100px;
        border-collapse:collapse;
    }
    th,td {
        border:1px solid #ccc;
        padding:5px 10px;
    }
    .blue {
        background:#FFFFFF;
    }
    tr:hover {
        background:#00FF00;
        color:#fff;
    }
    tr:hover th{
        color:#000;;
    }
</style>



<div >

<?php
$servername = "localhost";
$username = "root";
$password = "dcam09@CTC";
$dbname = "report_db";
// 创建连接
$con = new mysqli($servername, $username, $password, $dbname);
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
$sql = "SELECT suitName, buildNumber, caseName, testResult,timeCost,detailInfo, comments, checked_by FROM detail_result";
$result = $con->query($sql);

echo '<table class="table table-striped table-bordered">';
echo '<thead>';
echo '<th>SuitName&nbsp;</th>';
echo '<th>BuildNumber&nbsp;</th>';
echo '<th>CaseName&nbsp;</th>';
echo '<th>TestResult&nbsp;</th>';
echo '<th>TimeCost&nbsp;</th>';
echo '<th>DetailInfo&nbsp;</th>';
echo '<th>Comments&nbsp;</th>';
echo '<th>Checked_by&nbsp;</th>';
echo '</thead>';
echo '<tbody>';

;

if ($result->num_rows > 0) {
    // 输出每行数据
    while($row = $result->fetch_assoc()) {
        $suitName=$row["suitName"];
        $buildNumber=$row["buildNumber"];
        $caseName=$row["caseName"];
        $testResult=$row["testResult"];
        $timeCost=$row["timeCost"];
        $detailInfo=$row["detailInfo"];
        $checked_by=$row["checked_by"];

        echo "<tr class='blue'>";
        echo "<td>$suitName</td>";
        echo "<td>$buildNumber</td>";
        echo "<td>$caseName</td>";
        echo "<td>$testResult</td>";
        echo "<td>$timeCost</td>";
        echo "<td> <div style='border:1px solid red;width:150px; white-space:nowrap;text-overflow:ellipsis;overflow:hidden;'>$detailInfo</div></td>";
        echo "<td><a href='index.php'>Comments</a></td>";
        echo "<td>$checked_by</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}


echo '</tbody>';
echo "</table>";

?>
</div>



</body>
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
This is a demo of parase data from xml
<br/>
    <div ng-view="" id="ng-view"></div>
<?php
if (file_exists('reportfiles/WebUI/TEST-processDesingerComponentTabParameterSanitySYSP1.xml')) {
    $xml = simplexml_load_file('reportfiles/WebUI/TEST-processDesingerComponentTabParameterSanitySYSP1.xml');
} else {
    exit('Failed to open result.xml.');
}

$doc = new DOMDocument();
  $doc->load('reportfiles/WebUI/TEST-processDesingerComponentTabParameterSanitySYSP1.xml');

  $humans = $doc->getElementsByTagName("testcase");

// 创建连接
$servername = "localhost";
$username = "root";
$password = "dcam09@CTC";
$dbname = "report_db";
$con = new mysqli($servername, $username, $password, $dbname);


if (!$con) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';


$suitList = get_file_list("reportfiles/WebUI");
foreach($suitList as $suitName){
        foreach( $humans as $human )
        {
            $name = $human->getAttribute( "name" );
            $timecost = $human->getAttribute( "time" );
            $className = $human->getAttribute( "className" );
            $testResult = "Pass";
            $child ="";
            $buildNumber="5.5.1.1301";
            if($human->hasChildNodes()){
                $child = $human->getElementsByTagName("failure")->item(0)->nodeValue;
                $testResult = "Fail";
            }
            echo "$suitName";
            echo "===>";
            echo "$name";
            echo "=======";
            echo "$child</br>";

            mysqli_query($con,"INSERT INTO detail_result (suitName,buildNumber,caseName,className,testResult,timecost,detailInfo,comments,checked_by)
        VALUES ('$suitName','$buildNumber','$name','$className','$testResult','$timecost','$child','checked','wanpe02')");


        }
}

function get_file_list($directory)
{
    $fileList = array();
    $mydir = dir($directory);
    echo "<ul>\n";
    while($file = $mydir->read())
    {
        $pos = strrpos($file, ".xml");
        if ($pos != 0) {
            array_push($fileList, $file);
            echo "<li>$file</li>\n";
        }
    }
    echo "</ul>\n";
    $mydir->close();
    return $fileList;
}

?>

</body>
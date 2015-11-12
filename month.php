<?php include('lib.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>index</title>
    <style type="text/css" media="screen">
        div.fineprint {margin-left:100px; font-size:75%;}
    </style>
</head>
<body id="index" onload="">
    <ul>
<?php
    $year = intval($_GET["year"]);
    $month = intval($_GET["month"]);
    $list = Array();
    
    if ($year >= 2010 && $year <= 2020 && $month >= 1 && $month <= 12)
        $list = getDatesForPPEvent($year, $month);
    ksort($list);
    foreach ($list as $timestamp => $events)
    {
        $year = date("Y", $timestamp);
        $month = date("n", $timestamp);
        $day = date("j", $timestamp);
        foreach ($events as $event)
        {
            print("<li>");
            print($year . "-" . $month . "-" . $day);
            print(" : ");
            //print($event[0]);
            //print($event[0] . " : " . $event[1]);
            print($event[0] . "<div class=\"fineprint\">" . $event[1] . "</div>");
            print("</li>\n");
        }
    }
?>
</ul>
</body>
</html>
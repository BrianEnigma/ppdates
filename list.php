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
    <h1>Twelve Months of Puzzled Pint Dates</h1>
    <ul>
<?php
    $list = NULL;
    $now = time();
    $year = intval(date("Y", $now));
    $month = intval(date("n", $now));
    for ($i = 1; $i <= 12; $i++)
    {
        $list = getDatesForPPEvent($year, $month, $list);
        $month = $month + 1;
        if ($month > 12)
        {
            $year = $year + 1;
            $month = 1;
        }
    }
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
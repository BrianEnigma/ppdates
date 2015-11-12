<?php include('lib.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>index</title>
    <style type="text/css" media="screen">
        li {margin-top:10px; margin-bottom:10px;}
        form {margin:0; padding:0;}
    </style>
</head>
<body id="index" onload="">
    <ul>
        <li><a href="list.php">Twelve Months of Puzzled Pint Dates</a></li>
        <li><form action="month.php">Dates for: <select name="month"><?php
    $months = Array('', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    for ($m = 1; $m <= 12; $m++)
        print("<option value=\"" . $m . "\">" . $months[$m] . "</option>\n");
            
?></select> <select name="year"><?php
    for ($year = intval(date("Y", time())); $year <= 2020; $year++)
        print("<option value=\"" . $year . "\">" . $year . "</option>\n");
?></select>&nbsp;&nbsp;&nbsp;<input type="submit" value="View"></form></li>
        <li>TODO: iCal feed</li>
    </ul>

</body>
</html>
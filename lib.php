<?php

date_default_timezone_set('UTC');

// These are the T-minus and T-plus offsets (in days) for the various
// activities and cutoffs that are dependent upon the event date.
$OFFSETS = [
    [-7 * 12, 'Initial playtest by HQ + revisions begins', "All puzzles are ready for first review by Portland GC. Puzzles are iterated during these weeks. Volunteers help playtest a second round. Playtesters respond via feedback form."],
    [-7 * 7 - 1, 'Initial playtest by HQ + revisions ends', ""],
    [-7 * 7, 'Additional playtest rounds begin', "Revised puzzles are ready for volunteer playtesters. Puzzles are iterated during these weeks. Key volunteers (London, Canada, Vienna, New Zealand) playtest, looking for Americanisms."],
    [-7 * 3 - 1, 'Additional playtest rounds end', ""],
    [-7 * 3, 'QC window starts', "Puzzles are locked in. Final answer sheet. Single printable PDF. One final QC pass."],
    [-7 * 1, 'QC window closes', ""],
    [-7, 'Final PDFs to GDrive', ""],
    [-7, 'Nag cities for locations', ""],
    [-7, 'Remind cities to use social media', ""],
    [-7, 'Puzzles ready for printing', ""],
    [-5, 'Post location puzzle, tweet it', ""],
    [0, 'Puzzled Pint', ""],
    [1, 'Change homepage to next month, remove Polaroid', ""],
    [2, 'Remind cities to enter answer sheet data', ""],
    [7, 'Nag cities about answer sheet data', ""],
    [7, 'Update public standings', ""],
    [7, 'Tweet about standings', ""],
    [7, 'Upload puzzles and solutions', ""],
];

/// Get a list of the relevant dates for a given Puzzled Pint event.
/// The return value is a map of arrays:
///    key   : unix epoc timestamp for the day
///    value : array of events occurring on this day
/// You can pass in a map (such as the result of a previous call to
/// getDatesForPPEvent) and this function wil append to it.
function getDatesForPPEvent($year, $month, $incomingMap = NULL)
{
    global $OFFSETS;
    $months = Array('', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    $result = is_null($incomingMap) ? Array() : $incomingMap;
    $day = getPPDay($year, $month);
    for ($i = 0; $i < count($OFFSETS); $i++)
    {
        $offset = $OFFSETS[$i][0];
        $title = $months[$month] . " " . $OFFSETS[$i][1];
        $description = $OFFSETS[$i][2];
        $key = mktime(0, 0, 0, $month, $day, $year) + $offset * 24 * 60 * 60;
        $event = Array($title, $description);
        if (!array_key_exists($key, $result))
            $result[$key] = Array();
        array_push($result[$key], $event);
    }
    return $result;
}

function getPPDayOverride($year, $month)
{
    // If we decied to change December 2015 to the 15th of the month:
    //if (2015 == $year && 12 == $month) 
    //    return 15;
    return 0;
}

/// Return day of month of the PP meeting for the given month+year.
/// Month is 1..12
/// Year is the 4-digit year
function getPPDay($year, $month)
{
    $result = getPPDayOverride($year, $month);
    if (0 == $result)
    {
        $offset = ' second tuesday';
        $startOfMonth = mktime(0, 0, 0, $month, 1, $year, 0);
        $dayOfWeek = date('w', $startOfMonth);
        // If the first day of the week falls on a Tuesday, we want the next Tuesday, not two tuesdays from that date.
        if (2 == $dayOfWeek)
            $offset = ' first tuesday';
        $monthYearString = date('F Y', $startOfMonth);
        $result = date('j', strtotime($monthYearString . $offset));
    }
    return $result;
}
?>
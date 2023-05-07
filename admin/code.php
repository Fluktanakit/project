<?php
echo '<center>';
echo '<h3> FIX DATE OPEN & CLOSE  SYSTEM ';
echo '<br />';
$datenow = date('Y-m-d');
//$datenow = '2018-05-30';
$datestart = '2018-05-03';
$dateend =   '2018-05-30';
echo '<hr />';
echo 'current date : '.$datenow;
echo '<br />';
echo '<font color="blue">';
echo 'start date  : '.$datestart;
echo '<br />';
echo 'end date  : '.$dateend;
echo '</font>';
echo '<hr />';
	if($datenow  >= $datestart && $datenow <= $dateend) {
		echo '<font color="green">';
		echo 'Open System';
		echo '</font>';
	}else{
		echo '<font color="red">';
		echo 'Close System';
		echo '</font>';
	}
echo '<hr />';

echo 'Easy Code by devbanban.com';
echo '</h3>';
echo '</center>';
?>
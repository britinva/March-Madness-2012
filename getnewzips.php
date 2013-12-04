<?php
if (($handle = fopen("xandys.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    	$key = $data[4] .", ". $data[3];
		$val = array($data[4], $data[3], $data[1], $data[2]);
        $cities[$key] = $val;
    }
    fclose($handle);
}
//test script
//print_r($cities);
//echo $cities["NY, NEW YORK"];
?>
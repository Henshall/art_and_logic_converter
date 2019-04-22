<?php
require("Converter.php");
// =========================================================================
// TASK:
// ENCODE THE FOLLOWIGN NUMBERS:  6111, 340, -2628, -255, 7550
// DECODE THE FOLLOWIGN STRIGS:  0a0a, 0029, 3f0f, 4400, 5e7f
// WRITE THE ENCODED / DECODED VALUES TO THE CONVERTEDDATA.TXT FILE.
// =========================================================================

// create arrays of numbers to encode/decode
$encode_array = [6111, 340, -2628 , -255, 7550];
$decode_array = [ ["0a", "0a"], ["00","29"], ["3f","0f"] , ["44","00"], ["5e","7f"]];

// open file
$fp = fopen('ConvertedData.txt', 'w');

//loop through encode array and print values
foreach ($encode_array as $arr) {
  fwrite($fp,   "encode $arr => "   .  Converter::encode($arr)  . "\n"    );
}

//write spaces to seperate values
fwrite($fp,"\n");
fwrite($fp,"\n");

//loop through decode array and print values
foreach ($decode_array as $arr) {
  fwrite($fp, "decode $arr[0]$arr[1] => " . Converter::decode($arr[0], $arr[1] ) . "\n");
}
//close
fclose($fp);



 ?>

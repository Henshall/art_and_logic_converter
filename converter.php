<?php

// NOTE ON THE CONVERTER

// This function needs to accept a signed integer in the 14-bit range [-8192..+8191] and return a 4 character
// string.
// The encoding process is as follows:
// 1. Add 8192 to the raw value, so its range is translated to [0..16383]
// 2. Pack that value into two bytes such that the most significant bit of each is cleared
// Unencoded intermediate value (as a 16-bit integer):
//   3. Format the two bytes as a single 4-character hexadecimal string and return it.
//

// EXAMPLES:
// 0 should encode to 4000
// -8192 should encode to 0000
// 8191 should encode to 7F7F
// ETC.

class Converter
{
  public static function encode($num){
    // validate input
    if ($num < -8192 || $num > 8191) {
      return "you need to input a number between -8192 and 8191";
    }
    // add 8192
    $num = $num + 8192;
    // assign two "bytes" to each of the halves of the binary (since $num will always be 14 binary digets long, we can seperate them into 2 halves)
    $byte1 = $num >> 7;
    $byte2 = $num - ($byte1 << 7);

    // convert the "bytes" into a hexadecimal string.
    $byte1 = dechex($byte1);
    $byte2 = dechex($byte2);

    echo strlen($byte1) . "\n";
    echo strlen($byte2) . "\n";


    // convert to string - add missing 0's
    if (strlen($byte1) == 0) {
      $byte1 = "00";
    } elseif (strlen($byte1) == 1) {
      $byte1 = "0" . $byte1;
    }

    if (strlen($byte2) == 0) {
      $byte2 = "00";
    } elseif (strlen($byte2) == 1 && $byte2 != 0) {
      $byte2 = "0" . $byte2;
    }

    // concatenate and return
    return $byte1 . $byte2;

  }

  public static function decode($hi, $lo){

    // convert the hexadecimal strings, into decimal and then into binary
    $hi = decbin(hexdec($hi));
    $lo = decbin(hexdec($lo));
    // calculate number of "0"s to add
    $times = 7 - (int)strlen(strval($lo));
    // add 0's to lo
    for ($i=0; $i < $times; $i++) {
      $lo = "0" . $lo;
    }
    // concatenate
    $binary = $hi . $lo;
    // convert to decimal
    $num = bindec((int)$binary);
    // subtract 8192 and return
    return $num - 8192;
  }

}


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

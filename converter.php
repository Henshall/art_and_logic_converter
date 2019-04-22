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
    // get binary
    $binary = decbin($num);
    // assign two "bytes" to each of the halves of the binary (since $num will always be 14 binary digets long, we can seperate them into 2 halves)
    $byte1 = $num >> 7;
    $byte2 = $num - ($byte1 << 7);

    // convert the "bytes" into a hexadecimal string.
    $byte1 =  dechex($byte1);
    $byte2 = dechex($byte2);

    // convert to string
    if (strlen($byte1) == 0) {
      $byte1 = "00";
    } elseif (strlen($byte1) == 1) {
      $byte1 = "0" . $byte1;
    } elseif (strlen($byte1) == 2) {

    }

    if (strlen($byte2) == 0) {
      $byte2 = "00";
    } elseif (strlen($byte2) == 1) {
      $byte2 = "0" . $byte2;
    } elseif (strlen($byte2) == 2) {

    }

    // concatenate and return
    return $byte1 . $byte2;

  }

  public static function decode($hi, $lo){

    // convert the hexadecimal strings, into decimal
    $hi = hexdec($hi);
    $lo = hexdec($lo);

    // convert decimals into binary
    $hi = decbin($hi);
    $lo = decbin($lo);

    $times = 7 - (int)strlen(strval($lo));

    for ($i=0; $i < $times; $i++) {
      $lo = "0" . $lo;
    }
    $binary = $hi . $lo;
    $num = bindec((int)$binary);
    return $num - 8192;
  }

}

echo "encode returns === " .  Converter::encode(340) . "\n";
echo "decode returns === " .  Converter::decode("42", "54") . "\n";




 ?>

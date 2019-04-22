<?php

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


 ?>

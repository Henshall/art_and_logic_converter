<?php

class Converter
{
  public static function encode($num){

    // add 8192
    $num = $num + 8192;
    // get binary
    $binary = decbin($num);
    echo $binary;
    // assign two "bytes" to each of the halves of the binary (since $num will always be 14 binary digets long, we can seperate them into 2 halves)
    $byte1 = $num >> 7;
    $byte2 = $binary & $byte1;

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

    // echo $hi . "\n";
    // echo $lo . "\n";

    // convert decimals into binary
    $hi = decbin($hi);
    $lo = decbin($lo);

    // echo strlen(strval($lo)) . "\n";
    $times = 7 - (int)strlen(strval($lo)) ;
    for ($i=0; $i < $times; $i++) {
      $lo = "0" . $lo;
      echo " i = " . $i .   " lo = " . $lo . "\n";
    }



    echo $hi .  "\n";
    echo $lo .  "\n";
    $binary = $hi . $lo;

    echo $binary.  "\n";

    $num = bindec((int)$binary);


    return $num - 8192;
  }

}

echo "encode returns === " .  Converter::encode(2048) . "\n";
echo "decode returns === " .  Converter::decode("20", "00") . "\n";








 ?>

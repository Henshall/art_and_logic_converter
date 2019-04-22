# Converter for Art and Logic


## Task for Creating the Converter

For this task, you need to write a small program including a pair of functions that can
1. convert an integer into a special text encoding and then
2. convert the encoded value back into the original integer.

Assuming that your solution works correctly and cleanly enough to move forward in this process, these
functions will need to be used in your part 2 submission.

The Encoding Function
This function needs to accept a signed integer in the 14-bit range [-8192..+8191] and return a 4 character
string.

The encoding process is as follows:
1. Add 8192 to the raw value, so its range is translated to [0..16383]
2. Pack that value into two bytes such that the most significant bit of each is cleared
Unencoded intermediate value (as a 16-bit integer):
3. Format the two bytes as a single 4-character hexadecimal string and return it.

The Decoding Function:
Your decoding function should accept two bytes on input, both in the range [0x00..0x7F] and recombine
them to return the corresponding integer between [-8192..+8191]


EXAMPLES:
0 should encode to 4000
-8192 should encode to 0000
8191 should encode to 7F7F
ETC.


## HOW TO USE THE CONVERTER:
Simply include the Converter class using php's include or require functions

## GENERATING THE CONVERTEDDATA.TXT FILE:
For the assignment I needed to encode/decode various values. Simply run php GenerateData.php to generate the ConvertedData.txt file.

<?php
// 2) Write a class "LetterCounter" and implement a static method "CountLettersAsString" which receives a string parameter and returns a string that shows how many times each letter shows up in the string by using an asterisk (*).
// Example: "Interview" -> "i:**,n:*,t:*,e:**,r:*,v:*,w:*"
final class LetterCounter{

    /**
     * Counter Letters
     *
     * @param string $word
     * @return string
     */
    public static function CountLettersAsString(string $word) : string{
       $letters = [];

       foreach (count_chars($word, 1) as $i => $val) {
            $char = strtolower(chr($i));
            $counter = '';
            //Check to UpperCase and LowerCase
            if(array_key_exists($char,$letters)){
                $counter = $letters[$char];
            };
            $letters[$char] = str_repeat("*",$val).$counter;
       }

       return json_encode($letters);
    }
}

$counter = LetterCounter::CountLettersAsString("Interactive");
echo $counter;
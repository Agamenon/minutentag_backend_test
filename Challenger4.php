<?php
// 4) Write a method that triggers a request to http://echo.jsontest.com/john/yes/tomas/no/belen/yes/peter/no/julie/no/gabriela/no/messi/no,
// parse the json response. Using that data print two columns of data. The left column should contain the names of the persons that responses 'no',
// and the right column should contain the names that responded 'yes'

final class Chooser{

    public static function getTableOfChoosers(){
        $data = file_get_contents('http://echo.jsontest.com/john/yes/tomas/no/belen/yes/peter/no/julie/no/gabriela/no/messi/no', false);
        $dateObject = json_decode($data);
        $mask = "|%5.5s |%-5.5s |\n";
        printf($mask, 'No', 'Yes');
        foreach((array)$dateObject as $key => $value){
            printf($mask,($value == 'no') ? $key : '', ($value == 'yes') ? $key : '');
        }
    }
}

Chooser::getTableOfChoosers();
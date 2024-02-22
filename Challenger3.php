<?php
//3) Write a method that triggers a request to http://date.jsontest.com/,
// parses the json response and prints out the current date in a readable format as follows: Monday 14th of August, 2023 - 06:47 PM*

final class DateJson {

    /**
     * Get Date on Human Readable Format
     *
     * @return string
     */
    public static function getDateOnHumanReadableFormat() : string{
        $jsondate = file_get_contents('http://date.jsontest.com', false);
        $dateObject = json_decode($jsondate);
        $date = DateTime::createFromFormat('U.u', $dateObject->milliseconds_since_epoch/1000);
        return $date->format("l jS \of\ F, Y - H:i A");
    }
}

$date = DateJson::getDateOnHumanReadableFormat();
echo $date;
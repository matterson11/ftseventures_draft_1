<?php
require 'vendor/autoload.php';
include("Helper.php");
include("BaseController.php");

$client = new Scheb\YahooFinanceApi\ApiClient();

/*
 * Takes the 50 day and 200 day moving average of a company share price and provides a rating.
 */

class MovingAverageController extends BaseController
{

    function ftse100MovingAverage()
    {

        $symbols = $this->helper->getFtse100Symbols();
        $this->connect();
        $client = new Scheb\YahooFinanceApi\ApiClient();
        foreach ($symbols as $i => $symbol) {

            $updates = [];
            $symbol = $symbol["symbol"];
            $updates["symbol"] = $symbol; // Sets the $symbol value inside variable with key "symbol"
            // Current Price
            $current_price = $this->dayChange->lastTradePrice($symbol, $client);
            $updates['current_price'] = $current_price; // Set $current price variable inside $updates array

            $Fifty_Day_Moving_Avg = $this->movingAvg->fiftyDayMovingAverage($symbol, $client);
            $updates["Fifty_Day_Moving_avg"] = $Fifty_Day_Moving_Avg;
            if ($Fifty_Day_Moving_Avg < $current_price / 10) {
                $Fifty_Day_Moving_Avg = $Fifty_Day_Moving_Avg * 100;
            }

            $Twohundred_Day_Moving_Avg = $this->movingAvg->twoHundredDayMovingAverage($symbol, $client);
            $updates["Twohundred_Day_Moving_Avg"] = $Twohundred_Day_Moving_Avg;
            if ($Twohundred_Day_Moving_Avg < $current_price / 10) {
                $Twohundred_Day_Moving_Avg = $Twohundred_Day_Moving_Avg * 100;
            }

            $avg_change = $this->movingAvg->movingAvgGenerator($Fifty_Day_Moving_Avg, $Twohundred_Day_Moving_Avg);

            $updates["avg_change"] = $avg_change;

// Query updates the database with the above information
            $query = $this->mysqli->query("UPDATE ftse100 SET ftse100.200_day_avg = '" . $Twohundred_Day_Moving_Avg . "',
    ftse100.50_day_avg = '" . $Fifty_Day_Moving_Avg . "', ftse100.current_price = '" . $current_price . "',
    ftse100.avg_rating = '" . $avg_change . "'
WHERE ftse100.symbol = '" . $symbol . "'");
        }
    }

    function ftse250MovingAverage()
    {

        $symbols = $this->helper->getFtse250Symbols();
        $this->connect();
        $client = new Scheb\YahooFinanceApi\ApiClient();
        foreach ($symbols as $i => $symbol) {

            $updates = [];
            $symbol = $symbol["symbol"];
            $updates["symbol"] = $symbol; // Sets the $symbol value inside variable with key "symbol"
            // Current Price
            $current_price = $this->dayChange->lastTradePrice($symbol, $client);
            $updates['current_price'] = $current_price; // Set $current price variable inside $updates array

            $Fifty_Day_Moving_Avg = $this->movingAvg->fiftyDayMovingAverage($symbol, $client);
            $updates["Fifty_Day_Moving_avg"] = $Fifty_Day_Moving_Avg;
            if ($Fifty_Day_Moving_Avg < $current_price / 10) {
                $Fifty_Day_Moving_Avg = $Fifty_Day_Moving_Avg * 100;
            }

            $Twohundred_Day_Moving_Avg = $this->movingAvg->twoHundredDayMovingAverage($symbol, $client);
            $updates["Twohundred_Day_Moving_Avg"] = $Twohundred_Day_Moving_Avg;
            if ($Twohundred_Day_Moving_Avg < $current_price / 10) {
                $Twohundred_Day_Moving_Avg = $Twohundred_Day_Moving_Avg * 100;
            }

            $avg_change = $this->movingAvg->movingAvgGenerator($Fifty_Day_Moving_Avg, $Twohundred_Day_Moving_Avg);

            $updates["avg_change"] = $avg_change;

// Query updates the database with the above information
            $query = $this->mysqli->query("UPDATE ftse250 SET ftse250.200_day_avg = '" . $Twohundred_Day_Moving_Avg . "',
    ftse250.50_day_avg = '" . $Fifty_Day_Moving_Avg . "', ftse250.current_price = '" . $current_price . "',
    ftse250.avg_rating = '" . $avg_change . "'
WHERE ftse250.symbol = '" . $symbol . "'");
        }
    }
}


$movingAverage = new MovingAverageController();
$movingAverage->ftse100MovingAverage();
$movingAverage->ftse250MovingAverage();

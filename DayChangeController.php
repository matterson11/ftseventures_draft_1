<?php

require 'vendor/autoload.php';
include("Helper.php");
include("BaseController.php");

/*
 * This controller is called to run through the ftse100 and ftse250 companies and find out there current price and previous close price.
 * Then calculate the percentage change
 * This is being used to see which companies have been the main movies in a single day
 */

class DayChangeController extends BaseController
{
    function ftse100DayRange()
    {
        $symbols = $this->helper->getFtse100Symbols();
        $this->connect();
        $client = new Scheb\YahooFinanceApi\ApiClient();
        foreach ($symbols as $i => $symbol) {
            $symbol = $symbol["symbol"];
            // Current Price
            $current_price = $this->dayChange->lastTradePrice($symbol, $client);
            $previous_close = $this->dayChange->previousClose($symbol, $client);
            $percent_change = $this->dayChange->percentChange($current_price, $previous_close);
            $query = $this->mysqli->query("UPDATE ftse100 SET ftse100.current_price = '" . $current_price . "',
    ftse100.previous_close = '" . $previous_close . "', ftse100.day_change = '" . $percent_change . "'
    WHERE ftse100.symbol = '" . $symbol . "'");
        }
    }

    function ftse250DayRange()
    {
        $symbols = $this->helper->getFtse250Symbols();
        $this->connect();
        $client = new Scheb\YahooFinanceApi\ApiClient();
        foreach ($symbols as $i => $symbol) {
            $symbol = $symbol["symbol"];
            // Current Price
            $current_price = $this->dayChange->lastTradePrice($symbol, $client);
            $previous_close = $this->dayChange->previousClose($symbol, $client);
            $percent_change = $this->dayChange->percentChange($current_price, $previous_close);
            $query = $this->mysqli->query("UPDATE ftse250 SET ftse250.current_price = '" . $current_price . "',
    ftse250.previous_close = '" . $previous_close . "', ftse250.day_change = '" . $percent_change . "'
    WHERE ftse250.symbol = '" . $symbol . "'");
        }
    }
}

$dayChange = new DayChangeController();
$dayChange->ftse100DayRange();
$dayChange->ftse250DayRange();
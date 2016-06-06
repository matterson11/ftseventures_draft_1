<?php

/*
 * This class contains the functions the DayChangeController that looks at the main daily movers
 */

class DayChangeClass{


    public function percentChange($current_price, $previous_close)
    {
        if ($previous_close != 0 && $current_price != 0) {
            $day_range = ($current_price/$previous_close) * 100;

            if ($day_range > 100) {
                $perc_increase = $day_range - 100;
                $percent_change = round($perc_increase, 2);
            }
            if ($day_range < 100) {
                $perc_decrease = $day_range - 100;
                $percent_change = round($perc_decrease, 2);
            }
            if ($day_range == 100){
                $percent_change = 0;
            }
        }
        if ($previous_close == 0 && $current_price == 0) {
            $percent_change = 0;
        }
        return $percent_change;
    }

    public function lastTradePrice($symbol, $client)
    {

        try {
            $data = $client->getQuotesList("$symbol.L");
        } catch (Exception $ex) {
            $data = false;
        }
        $current_price = floatval($data["query"]["results"]["quote"]["LastTradePriceOnly"]);
        $current_price = round($current_price, 2);

        return $current_price;
    }

    public function previousClose($symbol, $client)
    {
        try {
            $data = $client->getQuotes("$symbol.L");
        } catch (Exception $ex) {
            $data = false;
        }
        $previous_close = floatval($data["query"]["results"]["quote"]["PreviousClose"]);
        $previous_close = round($previous_close, 2);
        return $previous_close;
    }

}
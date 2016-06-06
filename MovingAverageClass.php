<?php

class MovingAverageClass {

    public function fiftyDayMovingAverage($symbol, $client)
    {
        try {
            $data = $client->getQuotes("$symbol.L");
        } catch (Exception $ex) {
            $data = false;
        }
// Sets the $fifty day moving avg vaiable into $updates array
        $Fifty_Day_Moving_Avg = round(floatval($data["query"]["results"]["quote"]["FiftydayMovingAverage"]), 2);
        return $Fifty_Day_Moving_Avg;
    }

    public function twoHundredDayMovingAverage($symbol, $client)
    {
        try {
            $data = $client->getQuotes("$symbol.L");
        } catch (Exception $ex) {
            $data = false;
        }
        $Twohundred_Day_Moving_Avg = round(floatval($data["query"]["results"]["quote"]["TwoHundreddayMovingAverage"]), 2);
        return $Twohundred_Day_Moving_Avg;
    }

    public function movingAvgGenerator($Fifty_Day_Moving_Avg, $Twohundred_Day_Moving_Avg)
    {
        if ($Fifty_Day_Moving_Avg != 0 && $Twohundred_Day_Moving_Avg != 0) {
            $moving_avg_value = ($Fifty_Day_Moving_Avg / $Twohundred_Day_Moving_Avg) * 100;
            if ($moving_avg_value >= 100) {
                $perc_increase = $moving_avg_value - 100;
                $percent_increase = round($perc_increase, 2);
                if ($percent_increase <= 1) {
                    $avg_change = 5;
                }
                if ($percent_increase > 1 && $percent_increase <= 5) {
                    $avg_change = 6;
                }
                if ($percent_increase > 5 && $percent_increase <= 10) {
                    $avg_change = 7;
                }
                if ($percent_increase > 10 && $percent_increase <= 15) {
                    $avg_change = 8;
                }
                if ($percent_increase > 15 && $percent_increase <= 20) {
                    $avg_change = 9;
                }
                if ($percent_increase > 20) {
                    $avg_change = 10;
                }
            }
            if ($moving_avg_value < 100) {
                $perc_decrease = 100 - $moving_avg_value;
                $percent_decrease = round($perc_decrease, 2);
                if ($percent_decrease <= 1) {
                    $avg_change = 5;
                }
                if ($percent_decrease > 1 && $percent_decrease <= 5) {
                    $avg_change = 4;
                }
                if ($percent_decrease > 5 && $percent_decrease <= 10) {
                    $avg_change = 3;
                }
                if ($percent_decrease > 10 && $percent_decrease <= 15) {
                    $avg_change = 2;
                }
                if ($percent_decrease > 15) {
                    $avg_change = 1;
                }
            }
        }
        if ($Fifty_Day_Moving_Avg == 0 && $Twohundred_Day_Moving_Avg == 0) {
            $avg_change = 0;
        }
        return $avg_change;
    }

}
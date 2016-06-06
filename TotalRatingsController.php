<?php

include("Helper.php");
include("BaseController.php");

class TotalRatingsController extends BaseController
{

    function finalRatingScore($price_rating, $analyst_score, $avg_rating, $director_trade_rating, $trade_value_rating)
    {
        $rating_array = array($price_rating, $analyst_score, $avg_rating, $director_trade_rating, $trade_value_rating);
        $counts = array_count_values($rating_array);
        if (in_array("0", $rating_array)) {
            $zero_value = $counts['0'];
        } else {
            $zero_value = 0;
        }
        $total_rating = $price_rating + $analyst_score + $avg_rating + $director_trade_rating + $trade_value_rating;
        $divider = 5 - $zero_value;
        if ($divider >= 2) {
            $final_rating_score = round($total_rating / $divider, 2);
        }
        if ($divider < 2) {
            $final_rating_score = 0;
        }
        return $final_rating_score;
    }

    function total100Rating()
    {
        $symbols = $this->helper->getFtse100Symbols();
        foreach ($symbols as $i => $symbol) {
            $updates = [];
            $symbol = $symbol["symbol"];
            $updates["symbol"] = $symbol;

            $this->connect();
            $query = $this->mysqli->query("SELECT price_rating, analyst_score, avg_rating, director_trade_rating, trade_value_rating FROM ftse100
where symbol = '" . $symbol . "'");
            if (!$query->num_rows) {
                return false;
            }
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_array()) {
                    $price_rating = $row["price_rating"];
                    $analyst_score = $row["analyst_score"];
                    $avg_rating = $row["avg_rating"];
                    $director_trade_rating = $row["director_trade_rating"];
                    $trade_value_rating = $row["trade_value_rating"];
                    $final_rating_score = $this->finalRatingScore($price_rating, $analyst_score, $avg_rating, $director_trade_rating, $trade_value_rating);
                }
            }
            $query = $this->mysqli->query("UPDATE ftse100 SET ftse100.final_rating = '" . $final_rating_score . "'
        WHERE ftse100.symbol = '" . $symbol . "'");
        }
    }

    function total250Rating()
    {
        $symbols = $this->helper->getFtse250Symbols();
        foreach ($symbols as $i => $symbol) {
            $updates = [];
            $symbol = $symbol["symbol"];
            $updates["symbol"] = $symbol;
            $this->connect();
            $query = $this->mysqli->query("SELECT price_rating, analyst_score, avg_rating, director_trade_rating, trade_value_rating FROM ftse250
where symbol = '" . $symbol . "'");
            if (!$query->num_rows) {
                return false;
            }
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_array()) {
                    $price_rating = $row["price_rating"];
                    $analyst_score = $row["analyst_score"];
                    $avg_rating = $row["avg_rating"];
                    $director_trade_rating = $row["director_trade_rating"];
                    $trade_value_rating = $row["trade_value_rating"];
                    $final_rating_score = $this->finalRatingScore($price_rating, $analyst_score, $avg_rating, $director_trade_rating, $trade_value_rating);

                }
            }
            $query = $this->mysqli->query("UPDATE ftse250 SET ftse100.final_rating = '" . $final_rating_score . "'
        WHERE ftse250.symbol = '" . $symbol . "'");
        }

    }
}

$totalRating = new TotalRatingsController();
$totalRating->total100Rating();
$totalRating->total250Rating();






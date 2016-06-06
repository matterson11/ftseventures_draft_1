<?php

include('simple_html_dom.php');
require 'vendor/autoload.php';
include("Helper.php");
include("BaseController.php");

// Uploading the price target from Yahoo Finance for every company listed in the compant table

class PriceTargetController extends BaseController
{
    function ftse100PriceTarget()
    {
        $symbols = $this->helper->getFtse100Symbols();
        $this->connect();
        $client = new Scheb\YahooFinanceApi\ApiClient();

        foreach ($symbols as $i => $symbol) {
            $symbol = $symbol["symbol"];
            $incorrectSymbol = $this->priceTarget->ftse100TargetSymbols($symbol);
            if ($incorrectSymbol) {
                continue;
            }
            $url = "https://uk.finance.yahoo.com/q/ao?s=$symbol.L";
            $html = new simple_html_dom();
            $html->load_file($url);

            $tables = $html->find('table');
            $table_1 = $tables[4]->find('table');
            foreach ($table_1[4]->find('tr') as $j => $rows) {

                if ($j == 0) {
                    foreach ($rows->find("td") as $i => $bodies) {
                        if ($i == 1) {
                            $price = $bodies->plaintext;
                            $mean_price = floatval(str_replace(',', '', $price));

                            $current_price = $this->dayChange->lastTradePrice($symbol, $client);

                            $current_mean_price = $mean_price * 10;
                            // if the mean target is still less than current price even when timed by 10 then we create times the mean target by 100
                            if ($current_price > $current_mean_price) {
                                $mean_price = $mean_price * 100;
                            }
                            $change = $this->priceTarget->priceTarget($current_price, $mean_price);
                        }
                    }
                }
            }
            $query = $this->mysqli->query("UPDATE ftse100 SET ftse100.price_rating = '" . $change . "', ftse100.price_target = '" . $mean_price . "'
        WHERE ftse100.symbol = '" . $symbol . "'");
        }
    }

    function ftse250PriceTarget()
    {
        $symbols = $this->helper->getFtse250Symbols();
        $this->connect();
        $client = new Scheb\YahooFinanceApi\ApiClient();
        foreach ($symbols as $i => $symbol) {
            $symbol = $symbol["symbol"];
            $incorrectSymbol = $this->priceTarget->ftse250TargetSymbols($symbol);
            if ($incorrectSymbol) {
                continue;
            }
            $url = "https://uk.finance.yahoo.com/q/ao?s=$symbol.L";
            $html = new simple_html_dom();
            $html->load_file($url);

            $tables = $html->find('table');
            $table_1 = $tables[4]->find('table');
            foreach ($table_1[4]->find('tr') as $j => $rows) {
                if ($j == 0) {
                    foreach ($rows->find("td") as $i => $bodies) {
                        if ($i == 1) {
                            $price = $bodies->plaintext;
                            $mean_price = floatval(str_replace(',', '', $price));
                            $current_price = $this->dayChange->lastTradePrice($symbol, $client);
                            $current_mean_price = $mean_price * 10;
                            // if the mean target is still less than current price even when timed by 10 then we create times the mean target by 100
                            if ($current_price > $current_mean_price) {
                                $mean_price = $mean_price * 100;
                            }
                            $change = $this->priceTarget->priceTarget($current_price, $mean_price);
                        }
                    }
                }
            }

            $query = $this->mysqli->query("UPDATE ftse250 SET ftse250.price_rating = '" . $change . "', ftse250.price_target = '" . $mean_price . "'
        WHERE ftse250.symbol = '" . $symbol . "'");
        }
    }
}
$priceTarget = new PriceTargetController();
$priceTarget->ftse100PriceTarget();
$priceTarget->ftse250PriceTarget();

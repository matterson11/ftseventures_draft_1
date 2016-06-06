<?php
include("BaseController.php");
include("Helper.php");

class CompanyController extends BaseController
{
    public function getIndex()
    {
        $this->connect();
        $client = new Scheb\YahooFinanceApi\ApiClient();
        $search_results = new search();
        $search_results = $search_results->search($_GET['s']);

        if ($search_results) {
            foreach ($search_results['results'] as $search_result) {
                $symbol = $search_result->symbol;
                $name = $search_result->name;
            }
        }

        //$current_price = floatval($data["query"]["results"]["quote"]["LastTradePriceOnly"]);
        //$current_price = round($current_price, 2);

        $page = [];
        //$page['name'] = $name;
        //$page['symbol'] = $symbol;
        $page['data'] = $client->getQuotes("$symbol.L");
        $page['ask'] = round($page['data']["query"]["results"]["quote"]["Ask"], 2);
        $page['bid'] = round($page['data']["query"]["results"]["quote"]["Bid"], 2);
        //$page['daysChange'] = $page['data']["query"]["results"]["quote"]["Change_PercentChange"];
        $page['currency'] = $page['data']["query"]["results"]["quote"]["Currency"];
        $page['yearLow'] = $page['data']["query"]["results"]["quote"]["YearLow"];
        $page['yearHigh'] = $page['data']["query"]["results"]["quote"]["YearHigh"];
        $page['marketCap'] = $page['data']["query"]["results"]["quote"]["MarketCapitalization"];
        $page['changeFromYearLow'] = round($page['data']["query"]["results"]["quote"]["ChangeFromYearLow"], 2);
        $page['percentChangeFromLow'] = round($page['data']["query"]["results"]["quote"]["PercentChangeFromYearLow"], 2);

        $page['changeFromYearHigh'] = round($page['data']["query"]["results"]["quote"]["ChangeFromYearHigh"], 2);
        $page['percentChangeFromYearHigh'] = round($page['data']["query"]["results"]["quote"]["PercebtChangeFromYearHigh"], 2);
        //split day range into two varibales and round down to 2
        $page['daysRange'] = $page['data']["query"]["results"]["quote"]["DaysRange"];
        $page['fiftyDayMovingAverage'] = round($page['data']["query"]["results"]["quote"]["FiftydayMovingAverage"], 2);
        $page['twoHundredDayMovingAverage'] = round($page['data']["query"]["results"]["quote"]["TwoHundreddayMovingAverage"], 2);
        $page['open'] = $page['data']["query"]["results"]["quote"]["Open"];
        $page['previousClose'] = $page['data']["query"]["results"]["quote"]["PreviousClose"];
        $page['peRatio'] = $page['data']["query"]["results"]["quote"]["PERatio"];
        $page['exDividendDate'] = $page['data']["query"]["results"]["quote"]["ExDividendDate"];
        $page['pegRatio'] = $page['data']["query"]["results"]["quote"]["PEGRatio"];
        $page['priceEpsEstimateCurrentYear'] = round($page['data']["query"]["results"]["quote"]["PriceEPSEstimateCurrentYear"], 2);
        $page['priceEpsEstimateNextYear'] = round($page['data']["query"]["results"]["quote"]["PriceEPSEstimateNextYear"], 2);
        $page['stockExchange'] = $page['data']["query"]["results"]["quote"]["StockExchange"];

        $page['data'] = $client->getQuotesList("$symbol.L");
        $page['lastTradeDate'] = $page['data']["query"]["results"]["quote"]["LastTradeDate"];
        $page['lastTradeTime'] = $page['data']["query"]["results"]["quote"]["LastTradeTime"];
        $page['change'] = round($page['data']["query"]["results"]["quote"]["Change"], 2);
        $page['daysOpen'] = round($page['data']["query"]["results"]["quote"]["Open"], 2);
        $page['daysHigh'] = round($page['data']["query"]["results"]["quote"]["DaysHigh"], 2);
        $page['daysLow'] = round($page['data']["query"]["results"]["quote"]["DaysLow"], 2);
        $page['current_price'] = round($page['data']["query"]["results"]["quote"]["LastTradePriceOnly"], 2);

        $query = $this->mysqli->query("SELECT name, symbol, price_target, strong_buy, buy, hold, underperform, sell,
final_rating FROM ftse100 where symbol = '".$symbol."'
        union (select name, symbol, price_target, strong_buy, buy, hold, underperform, sell,
final_rating from ftse250 where symbol = '".$symbol."')");


       // $current_price = $this->dayChange->lastTradePrice($symbol, $client);
        //$previous_close = $this->dayChange->previousClose($symbol, $client);
        $current_price =  $page['current_price'];
        $previous_close = $page['previousClose'];
        $percent_change = $this->dayChange->percentChange($current_price, $previous_close);
        $page['daysChange'] = $percent_change;

        if ($query->num_rows > 0) {
            // output data of each row
            $row = $query->fetch_assoc();
            $page['name'] = $row["name"];
            $page['symbol'] = $row["symbol"];
            $page['price_target'] = $row["price_target"];
            $page['strong_buy'] = $row["strong_buy"];
            $page['buy'] = $row["buy"];
            $page['hold'] = $row["hold"];
            $page['underperform'] = $row["underperform"];
            $page['sell'] = $row["sell"];
            $page['final_rating'] = $row["final_rating"];
        }

        if ($page['final_rating'] == 0) {
            $page['rating_type'] = "Not enough data to provide accurate rating";
        }
        if ($page['final_rating'] > 0 && $page['final_rating'] < 3){
            $page['rating_type'] = "Sell";
        }
        if ($page['final_rating'] >= 3 && $page['final_rating'] < 5){
            $page['rating_type'] = "Underperform";
        }
        if ($page['final_rating'] == 5){
            $page['rating_type'] = "Hold";
        }
        if ($page['final_rating'] > 5 && $page['final_rating'] < 9){
            $page['rating_type'] = "Buy";
        }
        if ($page['final_rating'] >= 9 && $page['final_rating'] <= 10){
            $page['rating_type'] = "Strong Buy";
        }

        return $page;
    }


}

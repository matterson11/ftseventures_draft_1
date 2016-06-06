<?php
include("database.php");
require 'vendor/autoload.php';
include("header.php");
include("footer.php");
include("CompanyController.php");

$controller = new CompanyController();
$pageData = $controller->getIndex();
foreach ($pageData as $key => $value) {
    $$key = $value;
}

//extract($pageData);


?>

<div class="container">
    <section class="introduction-stripe">

    </section>
    <section>
        <hr class="heavy-line">
    </section>
    <section class="content-stripe">
        <div class="col-md-6">
            <h2><?php echo $name ?> (<span class="bold"><?php echo $symbol ?></span>)</h2>
            <h1><span class="bold"><?php echo $current_price ?></span>
                <?php
                if ($daysChange >= 0) { ?>
                    <span class="increase bold"> ( + <?php echo $daysChange ?>%)</span>
                    <span class="increase bold">  <?php echo $change ?></span>
                    <?php
                }
                if ($daysChange < 0) {
                    ?>
                    <span class="decrease bold"> ( <?php echo $daysChange ?>%</span>
                    <span class="decrease bold">  <?php echo $change ?></span>
                    <?php
                }
                ?>
            </h1>
        </div>
    </section>
    <section>
        <hr class="heavy-line">
    </section>
    <section class="content-stripe">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Information</h3>
                    <?php echo "
            <p>Asking Price: $ask</p>
            <p>Bid: $bid</p>
            <p>Change: $change</p>
            <p>Day Open: $daysOpen</p>
            <p>Day High: $daysHigh</p>
            <p>Day Low: $daysLow</p>
            <p>Last Trade Date: $lastTradeDate</p>
            <p>Last Trade Time: $lastTradeTime</p>";
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Current Analyst Ratings</h3>
                    <table class="table_data">
                        <tr class="analyst-data">
                            <th>Strong Buy</th>
                            <?php echo "<td>$strong_buy</td>"; ?>
                        </tr>
                        <tr class="analyst-data">
                            <th>Buy</th>
                            <?php echo "<td>$buy</td>"; ?>
                        </tr>
                        <tr class="analyst-data">
                            <th>Hold</th>
                            <?php echo "<td>$hold</td>"; ?>
                        </tr>
                        <tr class="analyst-data">
                            <th>Underperform</th>
                            <?php echo "<td>$underperform</td>"; ?>
                        </tr>
                        <tr class="analyst-data">
                            <th>Sell</th>
                            <?php echo "<td>$sell</td>"; ?>
                        </tr>
                    </table>
                    <br>
                    <?php echo
                    "<p>Current Price: $current_price</p>
            <p>Analyst Mean Price Target: $price_target</p>
            <p>Fifty Day Moving Average: $fiftyDayMovingAverage</p>
            <p>Two Hundred Moving Average: $twoHundredDayMovingAverage</p>
            <p>Our Rating: $final_rating = $rating_type</p>";
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Recent activity by <?php echo "$symbol"; ?> insiders</h3>
                    <table class="table_data">
                        <tr>
                            <th>Date</th>
                            <th>Buy / Sell</th>
                            <th>Volume</th>
                            <th>Value</th>
                        </tr>
                        <?php

                        $sql = "SELECT date, type, volume, trade_value from dealings where company_symbol = '" . $symbol . "' limit 10";
                        $result = $dbconfig->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $date = $row["date"];
                                $type = $row["type"];
                                $volume = $row["volume"];
                                $trade_value = $row["trade_value"];
                                echo
                                    '<tr>
                       <td>' . $date . '</td>
                       <td>' . $type . '</td>
                       <td>' . $volume . '</td>
                       <td>' . $trade_value . '</td>
                   </tr>';


                            }
                        } else {
                            echo "<h4>Not much activity from the business insiders</h4>";
                        }

                        ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section>
        <hr class="heavy-line">
    </section>
    <section class="content-stripe">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php echo "
<p>Stock Exchange: $stockExchange</p>
<p>Market Capitalisation: $marketCap</p>
<p>Currency: $currency</p>
<p>Ex Dividend Date: $exDividendDate</p>"; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php echo "
<p>Pe Ratio: $peRatio</p>
<p>PEG Ratio: $pegRatio</p>
<p>EPS Current Year: $priceEpsEstimateCurrentYear</p>
<p>EPS Next Year: $priceEpsEstimateNextYear</p>"; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php echo "
<p>Change from year low: $changeFromYearLow</p>
<p>% Change from year low: $percentChangeFromLow</p>
<p>Change from year high: $changeFromYearHigh</p>
<p>% Change from year high: $percentChangeFromYearHigh</p>"; ?>
                </div>
            </div>
        </div>
    </section>
</div>


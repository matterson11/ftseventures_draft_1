<?php
include("database.php");
include("header.php");
include("footer.php");
include("vendor/autoload.php");

include("MainPageController.php");

$controller = new MainPageController();
$pageData = $controller->getFtseCurrent();
foreach ($pageData as $key => $value) {
    $$key = $value;
}

?>


<div class="container">
    <section class="introduction-stripe">
        <div class="col-md-12">
            <h1 class="center">Project Name</h1>
            <h3 class="center">Project Name tries to predict how companies listed on the FTSE 100 & 250 will
                perform.</h3>
            <p class="center">To accomplish this the program examines the Analyst Recommendations, 50 & 200 Day Moving
                Averages
                and Director Dealings. It then produces a rating based out of 10. The higher the rating the strong the
                buy command.</p>
            <p class="center">This is a simple first Beta version to test the concept and research how these parameters
                effect a companies movement.</p>
            <p class="center">Don't take the recommendations too seriously.</p>
        </div>
    </section>
    <section class="content-stripe">
        <hr class="heavy-line">
    </section>

    <section class="content-stripe">

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>FTSE 100</h3>
                    <h2><?php echo $ftse100_price; ?>
                        <?php
                        if ($ftse100_price > $ftse100_previous_close) { ?>
                            <span class="increase"> <?php echo $ftse100_move ?></span>
                            <span class="increase"> <?php echo $ftse100_percent_change ?></span>
                            <?php
                        }
                        if ($ftse100_price < $ftse100_previous_close) {
                            ?>
                            <span class="decrease"> <?php echo $ftse100_move ?></span>
                            <span class="decrease"> <?php echo $ftse100_percent_change ?></span>
                            <?php
                        }
                        ?>
                    </h2>
                    <hr class="heavy-line">
                    <h3 class="center">Top Movers</h3>
                    <table class="table_data">
                        <tr>
                            <th>Symbol</th>
                            <th>Price</th>
                            <th>% Change</th>
                        </tr>
                        <?php
                        $url = "https://uk.finance.yahoo.com/q?s=^ftse";
                        $html = new simple_html_dom();
                        $html->load_file($url);

                        $tables = $html->find('table');
                        foreach ($tables[3]->find('tr') as $j => $rows) {
                            /*if ($j > 0) {*/
                            echo "<tr>";
                            foreach ($rows->find("td") as $i => $bodies) {
                                if ($i == 0) {
                                    $name = $bodies->plaintext;
                                    $name = str_replace('.L', '', $name);
                                    echo "<td>$name</td>";
                                }
                                if ($i == 1) {
                                    $price = $bodies->plaintext;
                                    echo "<td>$price</td>";
                                }
                                if ($i == 2) {
                                    $percent = $bodies->plaintext;
                                    //echo "<td>$percent</td>";

                                    $client = new Scheb\YahooFinanceApi\ApiClient();

                                    try {
                                        $data = $client->getQuotes("$name.L");

                                        $current_price = $price;
                                        $previous_close = $data["query"]["results"]["quote"]["PreviousClose"];

                                        if ($price > $previous_close) { ?>
                                            <td class="increase"> ( <?php echo $percent ?>)</td>
                                            <?php
                                        }
                                        if ($price < $previous_close) {
                                            ?>
                                            <td class="decrease"> ( <?php echo $percent ?>)</td>
                                            <?php
                                        }
                                    } catch (Exception $ex) {
                                        echo "<td>$percent</td>";
                                    }
                                }
                            }
                            /*  } */
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>FTSE 250</h3>
                    <h2><?php echo $ftse250_price; ?>
                        <?php
                        if ($ftse250_price > $ftse250_previous_close) { ?>
                            <span class="increase"> <?php echo $ftse250_move ?></span>
                            <span class="increase"> <?php echo $ftse250_percent_change ?></span>
                            <?php
                        }
                        if ($ftse250_price < $ftse250_previous_close) {
                            ?>
                            <span class="decrease"> <?php echo $ftse250_move ?></span>
                            <span class="decrease"> <?php echo $ftse250_percent_change ?></span>
                            <?php
                        }
                        ?>
                    </h2>
                    <hr class="heavy-line">
                    <h3 class="center">Top Movers</h3>
                    <table class="table_data">
                        <tr>
                            <th>Symbol</th>
                            <th>Price</th>
                            <th>% Change</th>
                        </tr>
                        <?php
                        $url = "https://uk.finance.yahoo.com/q?s=^ftmc";
                        $html = new simple_html_dom();
                        $html->load_file($url);

                        $tables = $html->find('table');
                        foreach ($tables[3]->find('tr') as $j => $rows) {
                            /*if ($j > 0) {*/
                            echo "<tr>";
                            foreach ($rows->find("td") as $i => $bodies) {
                                if ($i == 0) {
                                    $name = $bodies->plaintext;
                                    $name = str_replace('.L', '', $name);
                                    echo "<td>$name</td>";
                                }
                                if ($i == 1) {
                                    $price = $bodies->plaintext;
                                    echo "<td>$price</td>";
                                }
                                if ($i == 2) {
                                    $percent = $bodies->plaintext;
                                    //echo "<td>$percent</td>";
                                    $client = new Scheb\YahooFinanceApi\ApiClient();
                                    try {
                                        $data = $client->getQuotes("$name.L");

                                        $current_price = $price;
                                        $previous_close = $data["query"]["results"]["quote"]["PreviousClose"];

                                        if ($price > $previous_close) { ?>
                                            <td class="increase"> ( <?php echo $percent ?>)</td>
                                            <?php
                                        }
                                        if ($price < $previous_close) {
                                            ?>
                                            <td class="decrease"> ( <?php echo $percent ?>)</td>
                                            <?php
                                        }
                                    } catch (Exception $ex) {
                                        echo "<td>$percent</td>";
                                    }

                                }
                            }
                            /*  } */
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section class="content-stripe">
        <hr class="heavy-line">
    </section>

    <section class="content-stripe">
        <h3 class="center">Top recommendations from the FTSE 100 and 250.</h3>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table_data">
                        <tr>
                            <th>FTSE 100 Listed Company Name</th>
                            <th>Symbol</th>
                            <th>Price</th>
                            <th>Our Score</th>
                        </tr>
                        <?php

                        $sql = "SELECT name, symbol, current_price, final_rating FROM ftse100 order by final_rating desc limit 10";
                        $result = $dbconfig->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $name = $row["name"];
                                $symbol = $row["symbol"];
                                $price = $row["current_price"];
                                $score = $row["final_rating"];
                                ?>
                                <tr>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo $symbol ?></td>
                                    <td><?php echo $price ?></td>
                                    <td><?php echo $score ?></td>
                                </tr>

                                <?php
                            }
                        } else {
                            echo "0 results";
                        }

                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table_data">
                        <tr>
                            <th>FTSE 250 Listed Company Name</th>
                            <th>Symbol</th>
                            <th>Price</th>
                            <th>Our Score</th>
                        </tr>
                        <?php

                        $sql = "SELECT name, symbol, current_price, final_rating FROM ftse250 order by final_rating desc limit 10";
                        $result = $dbconfig->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $name = $row["name"];
                                $symbol = $row["symbol"];
                                $price = $row["current_price"];
                                $score = $row["final_rating"];
                                echo
                                    '<tr>
                       <td>' . $name . '</td>
                       <td>' . $symbol . '</td>
                       <td>' . $price . '</td>
                       <td>' . $score . '</td>
                   </tr>';


                            }
                        } else {
                            echo "0 results";
                        }

                        ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section class="content-stripe">
        <hr class="heavy-line">
    </section>
    <section class="content-stripe">
        <h3 class="center">FTSE 100 and 250 companies to hold or sell.</h3>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table_data">
                        <tr>
                            <th>FTSE 100 Listed Company Name</th>
                            <th>Symbol</th>
                            <th>Price</th>
                            <th>Our Score</th>
                        </tr>
                        <?php

                        $sql = "SELECT name, symbol, current_price, final_rating FROM ftse100 where final_rating > 0 order by final_rating asc limit 10";
                        $result = $dbconfig->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $name = $row["name"];
                                $symbol = $row["symbol"];
                                $price = $row["current_price"];
                                $score = $row["final_rating"];
                                echo
                                    '<tr>
                       <td>' . $name . '</td>
                       <td>' . $symbol . '</td>
                       <td>' . $price . '</td>
                       <td>' . $score . '</td>
                   </tr>';


                            }
                        } else {
                            echo "0 results";
                        }

                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table_data">
                        <tr>
                            <th>FTSE 250 Listed Company Name</th>
                            <th>Symbol</th>
                            <th>Price</th>
                            <th>Our Score</th>
                        </tr>
                        <?php

                        $sql = "SELECT name, symbol, current_price, final_rating FROM ftse250 where final_rating > 0 order by final_rating asc limit 10";
                        $result = $dbconfig->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $name = $row["name"];
                                $symbol = $row["symbol"];
                                $price = $row["current_price"];
                                $score = $row["final_rating"];
                                echo
                                    '<tr>
                       <td>' . $name . '</td>
                       <td>' . $symbol . '</td>
                       <td>' . $price . '</td>
                       <td>' . $score . '</td>
                   </tr>';


                            }
                        } else {
                            echo "0 results";
                        }

                        ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section class="content-stripe">
        <hr class="heavy-line">
    </section>

</div>




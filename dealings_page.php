<?php
include("header.php");
include("database.php");
include("footer.php");
?>

<div class="container">
    <section class="introduction-stripe">
        <h2 class="center">Director Dealings</h2>
        <br>
        <p class="center">Keep track of all major trades being made by company insiders</p>
    </section>
    <section class="content-stripe">
    <h2>Recent Large Director Buys</h2>
    <table class="table_data">
        <tr>
            <th>Date</th>
            <th>Name</th>
            <th>Symbol</th>
            <th>Volume</th>
            <th>Price</th>
            <th>Trade Value</th>
        </tr>
    <?php

    $sql = "SELECT date, company_name, company_symbol, volume, price, trade_value FROM dealings where type = 'Buy' order by date desc limit 25";
    $result = $dbconfig->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $date = $row["date"];
            $name = $row["company_name"];
            $symbol = $row["company_symbol"];
            $volume = $row["volume"];
            $price = $row["price"];
            $value = $row["trade_value"];
            echo
                '<tr>
                   <td>'.$date.'</td>
                   <td>'.$name.'</td>
                   <td>'.$symbol.'</td>
                   <td>'.$volume.'</td>
                   <td>'.$price.'</td>
                   <td>'.$value.'</td>
               </tr>';


        }
    } else {
        echo "0 results";
    }

    ?>
    </table>
</section>
    <section class="content-stripe">
    <h2>Recent Large Director Sells</h2>
    <table class="table_data">
        <tr>
            <th>Date</th>
            <th>Name</th>
            <th>Symbol</th>
            <th>Volume</th>
            <th>Price</th>
            <th>Trade Value</th>
        </tr>
    <?php

    $sql = "SELECT date, company_name, company_symbol, volume, price, trade_value FROM dealings where type = 'Sell' order by date desc limit 25";
    $result = $dbconfig->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $date = $row["date"];
            $name = $row["company_name"];
            $symbol = $row["company_symbol"];
            $volume = $row["volume"];
            $price = $row["price"];
            $value = $row["trade_value"];
            echo
                '<tr>
                   <td>'.$date.'</td>
                   <td>'.$name.'</td>
                   <td>'.$symbol.'</td>
                   <td>'.$volume.'</td>
                   <td>'.$price.'</td>
                   <td>'.$value.'</td>
               </tr>';
        }
    } else {
        echo "0 results";
    }

    ?>
        </table>
        </section>
</div>

<?php
include("BaseController.php");
include("Helper.php");
include('simple_html_dom.php');

class MainPageController extends BaseController
{

    public function getFtseCurrent()
    {

        $page = [];


        $url = "https://uk.finance.yahoo.com/q?s=^ftse";
        $html = new simple_html_dom();
        $html->load_file($url);
        $start = $html->find("span[id=yfs_l10_^ftse]", 0);
        $page["ftse100_price"] = $start->plaintext;
        // $ftse100_price
        $movement = $html->find("span[id=yfs_c10_^ftse]", 0);
        $page["ftse100_move"] = $movement->plaintext;
        // ftse100_move
        $change = $html->find("span[id=yfs_p20_^ftse]", 0);
        $page["ftse100_percent_change"] = $change->plaintext;
        // $ftse100_percent_change
        $prevClose = $html->find("td[class=yfnc_tabledata1]", 0);
        $page["ftse100_previous_close"] = $prevClose->plaintext;
        // ftse100_previous_close

        $url = "https://uk.finance.yahoo.com/q?s=^ftmc";
        $html = new simple_html_dom();
        $html->load_file($url);
        $start = $html->find("span[id=yfs_l10_^ftmc]", 0);
        $page["ftse250_price"] = $start->plaintext;
        // $ftse100_price
        $movement = $html->find("span[id=yfs_c10_^ftmc]", 0);
        $page["ftse250_move"] = $movement->plaintext;
        // ftse100_move
        $change = $html->find("span[id=yfs_p20_^ftmc]", 0);
        $page["ftse250_percent_change"] = $change->plaintext;
        // $ftse100_percent_change
        $prevClose = $html->find("td[class=yfnc_tabledata1]", 0);
        $page["ftse250_previous_close"] = $prevClose->plaintext;
        // ftse100_previous_close

        return $page;
    }
}


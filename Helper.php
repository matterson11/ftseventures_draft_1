<?php

include("MarketAnalysisClass.php");
include("DayChangeClass.php");
include("DirectorRatingsClass.php");
include("MovingAverageClass.php");
include("PriceTargetClass.php");

class Helper
{
    private $mysqli;

    public function __construct() {
        // Connect to our database and store in $mysqli property
        $this->connect();
    }

    private function connect() {
        $this->mysqli = new mysqli( 'localhost', 'root', '', 'proto2' );
    }

    public function getFtse100Symbols()
    { // need to sort out db config
        $query = $this->mysqli->query("SELECT symbol from ftse100");

        if ( ! $query->num_rows ) {
            return false;
        }

        $symbols = array();
        while ($row = $query->fetch_array()) {
            $symbols[] = $row;
        }

        return $symbols;

    }

    public function getFtse250Symbols()
    { // need to sort out db config
        $query = $this->mysqli->query("SELECT symbol from ftse250");

        if ( ! $query->num_rows ) {
            return false;
        }

        $symbols = array();
        while ($row = $query->fetch_array()) {
            $symbols[] = $row;
        }

        return $symbols;

    }

    public function getCompanyDealingSymbol()
    { // need to sort out db config
        $query = $this->mysqli->query("SELECT symbol from dealings_company");

        if ( ! $query->num_rows ) {
            return false;
        }

        $symbols = array();
        while ($row = $query->fetch_array()) {
            $symbols[] = $row;
        }

        return $symbols;

    }
}

<?php


class BaseController
{
    protected $mysqli;

    public function __construct() {
        $this->helper = new Helper;
        $this->analysis = new MarketAnalysisClass;
        $this->dayChange = new DayChangeClass;
        $this->directorRatings = new DirectorRatingsClass;
        $this->movingAvg = new MovingAverageClass;
        $this->priceTarget = new PriceTargetClass;
    }

    protected function connect() {
        $this->mysqli = new mysqli( 'localhost', 'root', '', 'proto2' );
    }

}
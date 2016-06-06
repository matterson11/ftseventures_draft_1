<?php

class PriceTargetClass {

    public function priceTarget($current_price, $mean_price){
        if ($mean_price !== 0) {
            $score_value = ($mean_price/$current_price) * 100; // Keeps giving errors division by zero
            if ($score_value > 100) {
                $perc_increase = $score_value - 100;
                $percent_increase = round($perc_increase, 2);
                if ($percent_increase <= 1) {
                    $change = 5;
                }
                if ($percent_increase > 1 && $percent_increase <= 10) {
                    $change = 6;
                }
                if ($percent_increase > 10 && $percent_increase <= 25) {
                    $change = 7;
                }
                if ($percent_increase > 25 && $percent_increase <= 50) {
                    $change = 8;
                }
                if ($percent_increase > 50 && $percent_increase <= 75) {
                    $change = 9;
                }
                if ($percent_increase > 75) {
                    $change = 10;
                }
            }
            if ($score_value < 100) {
                $perc_decrease = 100 - $score_value;
                $percent_decrease = round($perc_decrease, 2);
                if ($percent_decrease <= 1) {
                    $change = 5;
                }
                if ($percent_decrease > 1 && $percent_decrease <= 10) {
                    $change = 4;
                }
                if ($percent_decrease > 10 && $percent_decrease <= 25) {
                    $change = 3;
                }
                if ($percent_decrease > 25 && $percent_decrease <= 50) {
                    $change = 2;
                }
                if ($percent_decrease > 50) {
                    $change = 1;
                }
            }

        }
        return $change;
    }

    public function ftse100TargetSymbols($symbol)
    {
        if ($symbol == "CCH") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "DC") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "III") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "IMB") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "INTU") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "SKY") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "TUI") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "WOS") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
    }

    public function ftse250TargetSymbols($symbol) {
        if ($symbol == "AA") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "ACA") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "AGK") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "AMFW") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "AO") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "ASL") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "ATST") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "BBOX") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "BHMG") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "BNKR") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "BRSN") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "BTEM") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "BTG") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "CLDN") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "CRST") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "CTY") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "DFS") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "DJAN") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "DRTY") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "DTY") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "EDIN") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "ELTA") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "ESNT") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "FCSS") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "FCPT") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "FEV") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "FGT") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "FRCL") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "GSS") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "HMSF") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "HWDN") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "JAM") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "JE") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "JLIF") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "JMG") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "JRP") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "MGAM") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "MNKS") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "MRC") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "MYI") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "NBLS") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "PAYS") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "PCT") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "PLI") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "PNL") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "RCP") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "RDI") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "RSE") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "SCIN") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "SMT") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "SYNT") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "TED") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "TEM") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "TMPL") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "TRIG") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "TRY") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "UKCM") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "VM") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "WG") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "WKP") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "WPCT") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "WTAN") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
        if ($symbol == "WWH") {
            $incorrectSymbol = $symbol;
            return $incorrectSymbol;
        }
    }

}
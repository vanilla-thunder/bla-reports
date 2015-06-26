<?php

/**
 * [bla] Reports
 * The MIT License (MIT)
 *
 * Copyright (C) 2015  bestlife AG <oxid@bestlife.ag>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * Version:    2.0.0
 * Author:     Rafael Dabrowski
 * Author:     Marat Bedoev
 */
class bla_reports extends oxAdminView
{
    protected $_sThisTemplate = 'bla_reports.tpl';

    public function getReport()
    {
        $cfg  = oxRegistry::getConfig();
        $data = (object) json_decode(file_get_contents('php://input'), true);

        $what = $data->what;
        $over = $data->over;

        // x Achse
        switch($what)
        {
            
        }

        // y Achse
        $categories = [];
        switch($over)
        {
            case 'months':
                $categories = ['Jan', 'Feb', 'Maerz', 'Apr', 'Mai', 'Juni', 'Juli', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'];
                break;
            case 'years':
                $categories = [2000,2001,2002,2003,2004,2005,2006,2007,2008,2009,2010,2011,2012,2013,2014,2015,2016];
                break;
        }



        $aReport = [
            'options' => ['chart' => ['type' => 'line']],
            'title'   => ['text' => 'Bestellungen pro Monat', 'x' => -20],
            'xAxis'   => ['categories' => $categories],
            'yAxis'   => [
                'title' => ['text' => 'Bestellungen'],
                'min'   => 0
            ],
            /*'plotOptions' => [
                'line' => [
                    'dataLabels' => [ 'enabled' => true ],
                    'enableMouseTracking' => false
                ]],*/
            'series'  => []
        ];
        echo json_encode($aReport);
        exit;
    }


    public function orders()
    {
        $oDb = oxDb::getDb(FETCH_MODE_NUM);

        $aOrders = [
            'options' => ['chart' => ['type' => 'line']],
            'title'   => ['text' => 'Bestellungen pro Monat', 'x' => -20],
            'xAxis'   => ['categories' => ['Jan', 'Feb', 'Maerz', 'Apr', 'Mai', 'Juni', 'Juli', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez']],
            'yAxis'   => [
                'title' => ['text' => 'Bestellungen'],
                'min'   => 0
            ],
            /*'plotOptions' => [
                'line' => [
                    'dataLabels' => [ 'enabled' => true ],
                    'enableMouseTracking' => false
                ]],*/
            'series'  => []
        ];

        $aValues = $oDb->getArray('SELECT YEAR(oxorderdate), MONTH(oxorderdate), COUNT(*) FROM oxorder GROUP BY YEAR(oxorderdate), MONTH(oxorderdate) ORDER BY YEAR(oxorderdate) ASC, MONTH(oxorderdate)');
        $aData   = [];

        foreach ($aValues as $val) {
            if (!array_key_exists($val[0], $aData)) $aData[$val[0]] = array_fill(0, 12, null);
            $aData[$val[0]][$val[1] - 1] = intval($val[2]);
        }

        foreach ($aData AS $year => $data) {
            $aOrders['series'][] = ['name' => $year, 'data' => $data];
        }
        //$aOrders = ['series' => $aSeries, 'labels' => $aLabels, 'values' => $aData];
        echo json_encode($aOrders);
        exit;
    }

    public function paymethods()
    {

    }

}
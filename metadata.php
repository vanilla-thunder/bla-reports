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

$v = 'https://raw.githubusercontent.com/vanilla-thunder/bla-reports/master/copy_this/modules/bla/reports/version.jpg';
$sMetadataVersion = '1.1';
$aModule = array(
    'id'          => 'reports',
    'title'       => '<strong style="color:#95b900;font-size:125%;">best</strong><strong style="color:#c4ca77;font-size:125%;">life</strong> <strong>Reports</strong>',
    'description' => array(
        'en'=>'sales statistics for OXID eShop<hr/><b style="display: inline-block; float:left;">newest version:</b><img src="' . $v . '" style=" float:left;"/> (no need to update if you already have this version)',
        'de'=>'Verkaufsstatistiken für OXID eShop<hr/><b style="display: inline-block; float:left;">neuste Version:</b><img src="' . $v . '" style=" float:left;"/> (Update nicht nötig, falls diese Verion bereits installiert ist)',
        'ru'=>'статистика продаж для OXID eShop<hr/><b style="display: inline-block; float:left;">newest version:</b><img src="' . $v . '" style=" float:left;"/> (no need to update if you already have this version)'
    ),
    'thumbnail'   => 'bestlife.png',
    'version'     => '2.0.0',
    'author'      => 'bestlife AG',
    'email'       => 'oxid@bestlife.ag',
    'url'         => 'https://github.com/vanilla-thunder/bla-reports',
    'extend'      => array(),
    'files'       => array(
        'bla_reports' => 'bla/reports/files/bla_reports.php'
    ),
    'events'      => array(),
    'templates'   => array(
        'bla_reports.tpl'  => 'bla/reports/views/admin/bla_reports.tpl'
    ),
    'blocks'      => array(),
    'settings'    => array()
);
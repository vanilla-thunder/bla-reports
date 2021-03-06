<!DOCTYPE html>
<html lang="en">
<head>
    <title>[bla] Reports</title>    
    <meta name="description" content="">
    
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <link rel="stylesheet" type="text/css" href="[{$oViewConf->getModuleUrl("reports","out/lumx/dist/lumx.css")}]"/>
    <link rel="stylesheet" type="text/css" href="[{$oViewConf->getModuleUrl("reports","out/mdi/css/materialdesignicons.min.css")}]"/>
    [{* <link rel="stylesheet" type="text/css" href="[{$oViewConf->getModuleUrl("reports","out/angular-chart.js/dist/angular-chart.css")}]"/> *}]
    <link rel="stylesheet" type="text/css" href="[{$oViewConf->getModuleUrl("reports","out/reports.css")}]?v=[{$smarty.now}]"/>
</head>
<body ng-app="reportsApp" ng-controller="reportsCtrl">
<div class="card">
   <div class="toolbar">
      <div class="toolbar__left mr+++">
         <button class="btn btn--l btn--black btn--icon" lx-ripple>
            <i class="mdi mdi-menu"></i>
         </button>
      </div>

      <span class="toolbar__label fs-title">[bla] reports</span>

      <div class="toolbar__right">
         <button class="btn btn--m btn--white btn--fab" lx-ripple ng-click="load('orders');"><i class="mdi mdi-refresh"></i></button>
      </div>
   </div>
</div>
hallo
<hr/>
<highchart id="chart1" config="orders"></highchart>
<hr/>


<script type="text/javascript" src="[{$oViewConf->getModuleUrl("reports","out/jquery/dist/jquery.min.js")}]"></script>
<script type="text/javascript" src="[{$oViewConf->getModuleUrl("reports","out/angular/angular.min.js")}]"></script>
[{* lumx *}]
<script type="text/javascript" src="[{$oViewConf->getModuleUrl("reports","out/velocity/velocity.min.js")}]"></script>
<script type="text/javascript" src="[{$oViewConf->getModuleUrl("reports","out/moment/min/moment-with-locales.min.js")}]"></script>
<script type="text/javascript" src="[{$oViewConf->getModuleUrl("reports","out/lumx/dist/lumx.min.js")}]"></script>
[{* charts *}]
<script type="text/javascript" src="[{$oViewConf->getModuleUrl("reports","out/highcharts/highcharts.js")}]"></script>
<script type="text/javascript" src="[{$oViewConf->getModuleUrl("reports","out/highcharts-ng/dist/highcharts-ng.min.js")}]"></script>

<script>
    var app = angular.module('reportsApp', [ 'lumx','highcharts-ng' ])
        .controller('reportsCtrl', function($scope, $http, LxDialogService, LxNotificationService, LxProgressService) {
            
            $scope.load = function(fnc)
            {
                var url = '[{ $oViewConf->getSelfLink()|oxaddparams:"cl=bla_reports&fnc=xxxxxx"|replace:"&amp;":"&" }]';
                
                $http.get(url.replace("xxxxxx", fnc)).then(function (res)
                {
                    console.log(res.data);
                    $scope[fnc] = res.data;
                    if (res.data.error) { alert(res.data.error); }
                });
            }
            [{literal}]
            $scope.chartConfig = {
                options: { chart: {type: 'bar'} },
                series: [{ data: [10, 15, 12, 8, 7] }],
                title: { text: 'Hello' },
                loading: false
            }
            [{/literal}]
            $scope.orders = {};
            $scope.load('orders');
            
            
        });
</script>
</body>
</html>
﻿<!doctype html>
<html lang="en">

<head>
    <title>Commodity Trade Flow CSE 591</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.5/nv.d3.css" />
    <meta name="viewport" content="user-scalable=no, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./assets/lib/bootstrap/dist/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Rajdhani" rel="stylesheet">
    <script src="js/jquery-1.7.1.min.js"></script>
    <!-- graph network  -->
    <script src="graphjs/sigma.min.js" type="text/javascript" language="javascript"></script>
    <script src="graphjs/sigma.parseJson.js" type="text/javascript" language="javascript"></script>
    <script src="graphjs/jquery.fancybox.pack.js" type="text/javascript" language="javascript"></script>
    <script src="graphjs/main.js" type="text/javascript" language="javascript"></script>
    <!-- <link rel="stylesheet" type="text/css" href="js/jquery.fancybox.css" /> -->
    <link rel="stylesheet" href="graphcss/graphstyle.css" type="text/css" media="screen" />
    <link rel="stylesheet" media="screen and (max-height: 770px)" href="css/tablet.css" />
    <!-- <link rel="stylesheet" type="text/css" href="../../assets/css/keen-dashboardms.css" /> -->
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="geo-explorer.css" /> -->
</head>

<body onload="start()" id="dataviz" style="background:url('4.jpg');overflow:hidden;position:fixed;">
    <div id="app-toolbar" style="background: rgba(0,0,0,.75);
box-shadow: 0 1px 5px rgba(0,0,0,0);
color: #fff;
padding-bottom: 3px;
max-height: 6rem;
 border-bottom: 2px;
border-top-color:transparent;
border-right-color:transparent;
border-left-color:transparent;
    border-style: solid;
    border-bottom-color: rgb(0, 220, 224);
position: fixed;
top: 0px;
width: 100%;
z-index: 99;">
        <h3 class="pull-right">Global Trade<span style="color: #1da0e8"> Data Visualization</span></h3>
        <!-- <form name="myForm" action="" method="post">
            Name:
            <input type="text" name="fname">
            <input type="button" value="ss" onclick="imade()">
        </form>-->
        <form style="margin-top: 0rem;" action="" name="myForm2" onsubmit="return false;" method="post">
            <div class="row tools">
                <div class="col-sm-2">
                    <div class="tool radius" style="padding-left: 2rem;">
                        <div class=" noPointer" id="hudButtons">
                            <!--    <h5>Direction</h5> -->
                            <!--<input type="name" name="country" class="countryTextInput form-control pointer noMapDrag" style="background: black;color: #1da0e8;" value="UNITED STATES">-->
                            <select  id="direction" class="form-control" style="border-color:#1da0e8;border-style: solid;border-width: 1px;background: black;color: #1da0e8;">
                                <option value="">Select Trade Direction</option>
                                <option value="Imports">Imports</option>
                                <option value="Exports">Exports</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="tool coordinates">
                        <!--   <h5>Commodity</h5> -->
                        <!--<input type="name" step="any" style="background: black;color: #1da0e8;" id="coordinates-lng" name="country2" class="form-control" placeholder="Commodity">-->
                        <select id="commodity" class="form-control" style="background: black;color: #1da0e8;border-color:#1da0e8;border-style: solid;border-width: 1px;">
                            <option value="">Select Commodity</option>
                            <option value="coffee">Coffee</option>
                            <option value="copper">Copper</option>
                            <option value="corn">Corn</option>
                            <option value="cotton">Cotton</option>
                            <option value="crude">Crude Oil</option>
                            <option value="gold">Gold</option>
                            <option value="natural gas">Natural Gas</option>
                            <option value="silver">Silver</option>
                            <option value="sugar">Sugar</option>
                            <option value="wheat">Wheat</option>
                        </select>
                        <!--  <input type="number" step="any" id="coordinates-lat" class="form-control" placeholder="Latitude"> -->
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="tool coordinates">
                        <!-- <h5>Reporter</h5>
 -->
                        <!--<input type="name" step="any" style="background: black;color: #1da0e8;" id="coordinates-lng" class="form-control" placeholder="Commodity">-->
                        <select id="reporter" class="form-control" style="background: black;color: #1da0e8;border-color:#1da0e8;border-style: solid;border-width: 1px;">
                            <option value="">Select Reporter</option>
                            <option value="brazil">Brazil</option>
                            <option value="canada">Canada</option>
                            <option value="china">China</option>
                            <option value="france">France</option>
                            <option value="japan">Japan</option>
                            <option value="india">India</option>
                            <option value="mexico">Mexico</option>
                            <option value="russia">Russia</option>
                            <option value="uk">UK</option>
                            <option value="us">US</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="tool timeframe">
                        <!-- <h5>Partner</h5>
 -->
                        <!--<input type="date" id="timeframe-start" style="background: black;color: #1da0e8;" class="form-control" placeholder="mm/dd/yyyy">-->
                        <select id="partner" class="form-control" style="background: black;color: #1da0e8;border-color:#1da0e8;border-style: solid;border-width: 1px;" placeholder="Partner">
                            <option value="">Select Partner</option>
                            <option value="brazil">Brazil</option>
                            <option value="canada">Canada</option>
                            <option value="china">China</option>
                            <option value="france">France</option>
                            <option value="japan">Japan</option>
                            <option value="india">India</option>
                            <option value="mexico">Mexico</option>
                            <option value="russia">Russia</option>
                            <option value="uk">UK</option>
                            <option value="us">US</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-1" style="max-width:10rem;">
                    <div class="tool timeframe">
                        <input style="margin-top: 0rem;border-color:#1da0e8;border-style: solid;border-width: 1px; min-height: 3rem;min-width: 5rem;background-color: black;color: #1da0e8;" onclick="displayJSON();" type="button" id="timeframe-end" class=" form-control  " placeholder="Submit" value="Submit">
                    </div>
                </div>
                
                <!-- <i type="button" style="cursor: pointer; color: white;" class="fa fa-search-plus fa-3 zoomBtn zoomInBtn armsBtn pointer noMapDrag" aria-hidden="true"></i>
<i type="button" style="cursor: pointer; color: white;" class="fa fa-search-minus fa-3 zoomBtn zoomOutBtn armsBtn pointer noMapDrag" aria-hidden="true"></i>
 -->
            </div>
        </form>
        </br>
        <div id="query">
        </div>
    </div>
    <!-- graph  -->
    <div class="sigma-expand" id="sigma-canvas">
	<div style="margin-top:2rem;margin-left:15rem;color:#999;font-decoration:bold;">Country Trade Network</div>
        <style type="text/css">
        #sigma_edges_1,
        #sigma_nodes_1,
        #sigma_labels_1,
        #sigma_hover_1,
        #sigma_mouse_1,
        #sigma_monitor_1 {
            margin-top: 0rem;
            margin-left: 0rem!important;
            z-index: 9;
            position: fixed;
        }
        
        #sigma-canvas {
            canvas {
                margin-top: 30rem;
                margin-left: 0rem!important;
                z-index: 9;
                position: fixed;
            }
        }
        </style>
    </div>
    <!-- <div id="mainpanel" style="display: hidden;">
    <div class="col">
        <div class="b1">
            <form>
                <div id="search" class="cf">
                    <h2>Search:</h2>
                    <input type="text" name="search" value="Search by name" class="empty" />
                    <div class="state"></div>
                    <div class="results"></div>
                </div>
                <div class="cf" id="attributeselect">
                    <h2>Group Selector:</h2>
                    <div class="select">Select Group</div>
                    <div class="list cf"></div>
                </div>
            </form>
        </div>
    </div>
    <div id="information">
    </div>
</div>
 
 -->
    <div id="zoom">
        <i class="fa fa-square" style="color:rgba(95,198,19,0.6);" aria-hidden="true">'11</i>
        <i class="fa fa-square" style="color:rgba(234,134,21,0.6);" aria-hidden="true">'12</i>
        <i class="fa fa-square" style="color: rgba(0,202,255,0.6)" aria-hidden="true">'13</i>
        <i class="fa fa-square" style="color:rgba(198,134,233,0.6) " aria-hidden="true">'14</i>
        <i class="fa fa-square" style="color:rgba(46,144,114,0.6)" aria-hidden="true">'15</i>
        <!--<i class="fa fa-square" style="color:rgba(255,51,69,0.6)" aria-hidden="true">Destination</i>-->
        <div class="z" style="margin-top: 2rem;" rel="in"></div>
        <div class="z"  style="margin-top: 2rem;" rel="out"></div>
        <div class="z"   style="margin-top: 2rem;" rel="center"></div>
    </div>
    <!-- graph end -->
    <!--  <div style="margin-bottom: 5rem;"></div> -->
    <div id="wrapper" class="row">
        <div id="loading" class="col-md-12">
            <!-- <h2>Loading...</h2>
 -->
        </div>
        <div id="mainCont" class="container">
            <canvas class="col-md-3" style="max-height: 40rem;max-width: 40rem;margin-left: -5rem;margin-top:11rem; z-index:9" id="m"></canvas>
            <canvas class="col-md-3 pull-left" style="max-height: 25rem;max-width: 30rem;margin-left: -20rem;margin-top:10rem;z-index:9 " id="piechart"></canvas>
            <canvas class="col-md-3 pull-right" style="max-height: 20rem;max-width: 23rem;margin-left: 10rem;margin-top:11rem; z-index:9" id="doughnut"></canvas>
        </div>
        <!-- <div id="m" style="min-width: 310px; height: 400px; margin: 0 auto"></div> -->
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="panel medium-panel col-sm-12 col-md-12 animated zoomIn" style="color:white;background-color: rgba(0, 0, 0, 0);
                                z-index: -3;
                                        border: none;
                                       margin-top: 10rem;
                                        border-radius: 5px;
                                        position: relative;
                                        margin-bottom: 24px;
                                        color: white;
                                        margin-left: -1rem;
                                        box-shadow: 0 5px 5px 0 rgba(0, 0, 0, 0);
                                            height: 20rem;" zoom-in="">
                <style>
                #chart svg {
                    height: 600px;
                    width: 600px;
                }
                </style>
                <div id="chart">
                    <svg></svg>
                </div>
            </div>
        </div>
        <div id="visualization">
            <!-- 2D overlay elements go in here -->
            <div id="app-maparea" style="background-color: ;">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div id="glContainer" style="max-height: 12rem;">
                        <!-- 3D webgl canvas here -->
                    </div>
                    <!-- </canvas> -->
<!--                    <img src="images/index.png" style="max-height: 52.3rem;margin-top:-30rem ; margin-left:10rem;pointer-events: none;"></img>-->
                    <img src="glow.png" style="max-height: 80rem;margin-top:-123rem ; margin-left:-6rem;pointer-events: none;z-index: -1"></img>
                    <div class="" style="margin-top: -40rem;">
                        <table id="marker_template" class="marker pull-right" style="left:60rem !important;top:-20rem;font-weight: 1px;color: white;z-index: -90;">
                            <tr>
                                <td><span id="countryText" class="country">
                        </span>
                                </td>
                                <td class="detail" id="detailText">
                                    <span id="detailText" class="detail"></span>
                                </td>
                            </tr>
                        </table>
                        <div class="panel medium-panel  animated zoomIn" style="color:white;background-color: rgba(0, 0, 0, 0);
                     z-index: -9;position: fixed;
                                        border: none;
                                        border-radius: 5px;
                                        position: relative;
                                        margin-bottom: 24px;
                                        margin-top: -8rem;
                                        margin-left: 6rem;
                                        box-shadow: 0 5px 5px 0 rgba(0, 0, 0, 0);
                                            height: 50rem;" zoom-in="">
                            <!-- <form class="pull-right" action="">
    <input type="checkbox" name="Gold" value="Gold"><img style="max-height: 20px;" src="gold.png" alt="some img">
    <br>
    <input type="checkbox" name="vehicle" value="Car">I have a car
</form>
 -->
                            <div id="importExportBtns" class="pull-right col-md-1">
                                <div class="typeLabels">
                                    <!--  <input type="checkbox" name="Coffee">Coffee</input>
                                    <input type="checkbox" name="Gold">Gold</input>
                                    <input type="checkbox" name="Silver">Silver</input> -->
                                    <div class="civ"></div>
                                    <div class="ammo"></div>
                                    <br class="clear">
                                </div>
                                <div class="imports imex">
                                    <div class="mil">
                                        <div class="check"></div>
                                    </div>
                                    <div class="civ">
                                        <div class="check"></div>
                                    </div>
                                    <div class="ammo">
                                        <div class="check"></div>
                                    </div>
                                    <div class="label"></div>
                                    <br class="clear">
                                </div>
                                <div class="exports imex">
                                    <div class="mil">
                                        <div class="check"></div>
                                    </div>
                                    <div class="civ">
                                        <div class="check"></div>
                                    </div>
                                    <div class="ammo">
                                        <div class="check"></div>
                                    </div>
                                    <div class="label"></div>
                                    <br class="clear">
                                </div>
                                <br class="clear" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12">
                <div class="panel medium-panel col-sm-12 col-md-12 animated zoomIn" style="color:white;background-color: rgba(0, 0, 0, 0);
                                z-index: -3;
                                        border: none;
                                       margin-top: 20rem;
                                        border-radius: 5px;
                                        position: relative;
                                        margin-bottom: 24px;
                                        margin-left: -1rem;
                                        box-shadow: 0 5px 5px 0 rgba(0, 0, 0, 0);
                                            height: 10rem;" zoom-in="">
                    <style>
                    #chart svg {
                        height: 600px;
                        width: 600px;
                        padding-left: 40px;
                        font-size: 20px;
                        font-family: 'Roboto';
                        fill : rgb(31, 63, 37, 1); 
                    } 
                    </style>
                    <div id="chart svg">
                        <svg >
                        </svg>
                    </div>
                </div>
            </div>
            <div id="app-sidebar" class=" pull-right">
            </div>
        </div>
        <script src="https://use.fontawesome.com/d1ef69c3f4.js"></script>
        <script type="text/javascript" src="./assets/lib/keen-js/dist/keen.min.js"></script>
        <script type="text/javascript" src="./assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="./assets/js/meta.js"></script>
        <script src="js/Detector.js"></script>
        <script src="js/Tween.js"></script>
        <script src="js/dat.gui.min.js"></script>
        <script src="js/Three.js"></script>
        <script src="three.js"></script>
        <script src="js/THREEx.KeyboardState.js"></script>
        <script src="js/THREEx.WindowResize.js"></script>
        <script src="js/Stats.js"></script>
        <script src="js/jquery-ui-1.8.21.custom.min.js"></script>
        <script src="js/RequestAnimationFrame.js"></script>
        <script src="js/ShaderExtras.js"></script>
        <script src="js/canvg.js"></script>
        <script src="js/rgbcolor.js"></script>
        <script src="js/innersvg.js"></script>
        <script type="text/javascript" src="js/StereoEffect.js"></script>>
        <script src="js/util.js"></script>
        <script src="js/mousekeyboard.js"></script>
        <script src="js/datguicontrol.js"></script>
        <script src="js/dataloading.js"></script>
        <script src="js/camerastates.js"></script>
        <script src="js/geopins.js"></script>
        <script src="js/visualize.js"></script>
        <script src="js/visualize_lines.js"></script>
        <script src="js/markers.js"></script>
        <script src="js/svgtoy.js" type="text/javascript"></script>
        <script src="js/datartvl.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
        <!-- <script src="js/d3.v2.min.js"></script> -->
        <script src="js/ui.controls.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.5/nv.d3.js"></script>
        <script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <!-- <script type="text/javascript" src="nvd3ex.js"></script> -->
        <script src="js/circularHeatChart.js"></script>
        <div class="globe" style="max-height: 8rem; max-width: 8rem;">
            <script src="js/main.js" type="text/javascript"></script>
            <script type="text/javascript">
            var chart_com ;
            var chart_don ;
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-7963116-1']);
            _gaq.push(['_setDomainName', 'chromeexperiments.com']);
            _gaq.push(['_trackPageview']);
            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
            </script>
            <script type="text/javascript" src="geo-explorer.js"></script>
            <script type="text/javascript">
            function drawSpiralHeatMap(historyData,max,min) {
				if(chart_com != null){
					chart_com.destroy();
				}
				if(chart_don != null){
					chart_don.destroy();
				}
               // alert("max and mind : "+max+" , "+min);
                var com = document.getElementById("commodity").value;
                var dir = document.getElementById("direction").value;
                var countries = ["brazil", "canada", "china", "france", "japan", "india", "mexico", "russia", "uk", "us"];
                var years = [];
                for (var i = 2011; i < 2016; i++)
                    years.push(i);

                /* Create the chart */
                var chart = circularHeatChart()
                    .segmentHeight(18)
                    .innerRadius(15)
                    .numSegments(10)
                    .domain([min, max])
                    .range(['rgb(105, 183, 221,0.7)', 'rgba(255, 255, 255,1)'])
                    .segmentLabels(countries)
                    .radialLabels(years);

                d3.select('#chart svg')
                    .selectAll('svg')
                    .data([historyData])
                    .enter()
                    .append('svg')
                    .text("Historical "+dir+" trend for "+com)
                    .call(chart);

            }
                
        
            function drawbargrph(xlables, barlabelp, bardata_one,labels,val1,val2) {
                
                //alert("old chart "+ val1+" val2"+val2);
                if(chart_com != null){
                    chart_com.destroy();
                }
                var bg_color = [];
                for(var i=0; i<bardata_one.length;i++){
                    bg_color.push("rgba(4, 207, 194,0.6)");
                }
                var ctx = document.getElementById('m').getContext('2d');
                chart_com = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: xlables,
                        datasets: [{
                            label: barlabelp,
                            data: bardata_one, 
                            backgroundColor: bg_color,
                            borderWidth : 1
                        }]
                    },options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                },
                                scaleLabel: {
                                display: true,
                                fontSize: 15,
                                fontColor: "rgb(255, 255, 255,0.6)",
                                labelString: 'NetValue in $'
                              }
                            }],
                            xAxes: [{
                                scaleLabel: {
                                display: true,
                                fontSize: 15,
                                fontColor: "rgb(255, 255, 255,0.6)",
                                labelString: labels
                              }
                            }]
                        }
                    }
                    
                });
                console.log('drawing graph');
                //console.log(input.commodityinput.commodity);
                if(chart_don != null){
                    chart_don.destroy();
                }
                var ctx2 = document.getElementById("doughnut").getContext('2d');
                chart_don = new Chart(ctx2, {
                    type: 'doughnut',
                    data: {
                        
                        labels: ["Total Imports", "Total Exports"],
                        datasets: [{
                            backgroundColor: [
                                "rgb(95, 198, 19,0.6)",
                                "rgb(234, 134, 21,0.6)"


                            ],
                            data: [val1, val2],
                            borderWidth: [0, 0]
                        }]

                    },
                    options: {

                        cutoutPercentage: 50,
                        title: {
                                    display: true,
                                    fontSize: 20,
                                    fontColor: "rgb(255, 255, 255,0.6)",
                                    text: 'Trade Distribution for '+document.getElementById("reporter").value+" in "+selectionData.selectedYear
                                }

                    }
                });

            }
            </script>
            <script type="text/javascript">
            function drawPiegrph(labels, data, alfa) {
               
//                var pieChartContent = document.getElementById('mainCont');
//                pieChartContent.innerHTML = '&nbsp;';
//                $('#mainCont').append('<canvas class="col-md-3 pull-left" style="max-height: 25rem;max-width: 25rem;margin-left: -20rem;margin-top:10rem;z-index:9 " id="piechart"></canvas>');
                //alert("old chart "+ chart_com);
                if(chart_com != null){
                    chart_com.destroy();
                }
                var dir = document.getElementById("direction").value;
                var dir_len = dir.length;
                var ctx = $("#piechart").get(0).getContext("2d");
                
                var colors = [
                                "rgb(215, 48, 39)",
                                "rgb(244, 109, 67)",
                                "rgb(253, 174, 97)",
                                "rgb(254, 224, 144)",
                                "rgb(255, 255, 191)",
                                "rgb(224, 243, 248)",
                                "rgb(171, 217, 233)",
                                "rgb(116, 173, 209)",
                                "rgb(69, 117, 180)",
                                "rgb(49, 54, 149)"
                            ];
                var bg_color = [];
                for(var i=0; i<labels.length ; i++){
                    bg_color.push(colors[i]);
                }
                var ctx = document.getElementById("piechart").getContext('2d');
                chart_com = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels, //["M", "T", "W", "T", "F", "S", "S"],
                        datasets: [{
                            backgroundColor: bg_color,
                            data: data // [12, 19, 3, 17, 28, 24, 7]
                        }]
                    },
                    options: {
                        legend: {
//                            labels: {
//                                padding: 20
//                              },
                            display: true
                        },
                        tooltips: {
                            enabled: true
                        },
                        title: {
                                    display: true,
                                    fontSize: 15,
                                    fontColor: "rgb(255, 255, 255,0.6)",
                                    text: 'Commodities '+dir.substr(0,dir_len-1)+'ed from '+document.getElementById("reporter").value+" to "+document.getElementById("partner").value
                                }
                    }
                });

            }
            </script>
        </div>
        <!-- All other hud can go here-->
        <!-- <div id="hudHeader" class="over
layCountries noPointer">
    <h1 class="noPointer">Small Arms and Ammunition — Imports & Exports
                <div class="subtitle">An interactive visualization of government-authorized small arms and ammunition transfers from 1992 to 2010. </div>
            </h1>
</div>
 -->
        <div id="history" class=" noPointer" style="background-color:rgb(0,0,0,.5);border-top-left-radius: 2em ;border-top-right-radius: 2em;">
            <!-- <div class="graph"> -->
            <!--      <div class="close"></div>
                <div class="labels">
                    <div class="change">RELATIVE PERCENT CHANGE</div>
                    <div class="exports">EXPORTS</div>
                    <div class="imports">IMPORTS</div>
                    <br class="clear" />
                </div>
                <div class="container noPointer"></div>
            </div> -->
            <ul class="timeline pointer">
                <li style="padding-right : 150px; padding-left : 20px">2011</li>
                <li style="padding-right : 150px;">2012</li>
                <li style="padding-right : 150px;">2013</li>
                <li style="padding-right : 150px;">2014</li>
                <li>2015</li>
                <div id="handle" class="noMapDrag"></div>
            </ul>
        </div>
        <!-- <div id="graphIcon" class=""></div>
 -->
        <div class="">
        </div>
        <div id="aboutContainer" class=''>
            <div class="arrowUp"></div>
            <div id="aboutBox">
                <!-- <div class="title">Information about the data</div>
 -->
                <!-- <div class="text">
    This data visualization was produced by Google as part of the <a href="http://www.google.com/ideas" target="_blank">Google Ideas</a> INFO (Illicit Networks, Forces in Opposition) Summit with support from the <a href="http://igarape.org.br/" target="_blank">Igarape Institute</a> and data provided by the <a href="http://www.prio.no/" target="_blank">Peace Research Institute Oslo (PRIO)</a> small arms database. The visualization includes >1 million individual import and export data points from annual custom reports and maps the transfer of small arms, light weapons and ammunition across 250 nation states and territories around the world between 1992 and 2010.
</div>bar
 -->
                <!-- <div class="links">
    <br> For more info, please see the <a href="http://igarape.org.br/armsglobe" target="_blank">FAQs</a>.
</div>
 -->
            </div>
        </div>
    </div>
</body>
<style type="text/css">
.tool {
    padding-top: 1rem;
    font-family: 'Rajdhani', sans-serif;
    background: black;
    color: white;
    min-height: 2rem;
    width: 100%;
}

canvas {
    margin-left: -35rem;
    margin-top: -22rem;
    max-width: 1500rem;
    /*margin-left: 0rem; max-width: 60rem; margin-top: 20rem;
*/
}

#history {
    position: fixed;
    bottom: 0;
    left: 0px;
    background-color: rgba(43, 43, 43, 0.9);
    display: none;
}

#history ul {
    list-style-type: none;
    margin: 10px;
    padding: 0;
    /* padding-bottom: 15px; padding-top: 22px;
*/
    color: white;
    font-size: 12px;
    font-family: 'Roboto';
    width: 668px;
    background: url('timelineBG.png') 8px 0 no-repeat;
    /*to be resized!*/
}

#history ul li {
    width: 35px;
    float: left;
    text-align: center;
    margin-top: -30px;
    padding-top: 30px;
    cursor: pointer;
}

#history .timeline #handle {
    cursor: pointer;
    width: 36px;
    height: 36px;
    background: url('yearHandle.png') 0px 0 no-repeat;
    position: absolute;
    bottom: 20px;
    left: 25px;
}

#history .graph {
    display: none;
}

#history .close {
    width: 8px;
    height: 8px;
    background: url('close.png') 0 0 no-repeat;
    margin-right: 8px;
    margin-top: 5px;
    float: right;
    cursor: pointer;
    pointer-events: auto;
}

#history .labels {
    margin-right: 35px;
}

#history .labels .change {
    font-family: RopaSans;
    font-size: 23px;
    color: white;
    margin-left: 31px;
    float: left;
    margin-top: 10px;
}

#history .labels .imports {
    float: right;
    font-family: Roboto;
    font-size: 14px;
    color: #70B4CB;
    margin-top: 10px;
}

#history .labels .exports {
    float: right;
    font-family: Roboto;
    font-size: 14px;
    color: #FFA90B;
    margin-top: 10px;
    margin-left: 10px;
}
</style>
<style type="text/css">
.panel {
    &.animated {
        animation-duration: 0.5s;
    }
    &.small-panel {
        height: 20rem;
    }
    &.xsmall-panel {
        height: 10rem;
    }
    &.medium-panel {
        height: 10rem;
    }
    /* &.xmedium-panel {
                                            height: $extra-medium-panel-height;
                                        }
                                        &.large-panel {
                                            height: $large-panel-height;
                                        }*/
    &.viewport100 {
        height: calc(100vh - 218px);
    }
    &.with-scroll {
        .panel-body {
            height: calc(100% - #{$panel-title-height});
            overflow-y: auto;
        }
    }
}
</style>

</html>

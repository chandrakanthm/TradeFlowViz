<!doctype html>
<html lang="en">

<head>
    <title>Commodity Trade Flow CSE 591</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.5/nv.d3.css" />
    <meta name="viewport" content="user-scalable=no, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./assets/lib/bootstrap/dist/css/bootstrap.min.css" />
    <!-- <link rel="stylesheet" type="text/css" href="../../assets/css/keen-dashboards.css" /> -->
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="geo-explorer.css" /> -->
</head>

<body onload="start()" id="dataviz" style="background: url('blur-bg.jpg');">
    <div id="app-toolbar" style="background: rgba(0,0,0,.75);
box-shadow: 0 1px 5px rgba(0,0,0,.5);
color: #fff;
padding-bottom: 3px;
/*position: fixed;*/
top: 0px;
width: 100%;
z-index: 1;">
        <form action="" onsubmit="return false;" method="post">
            <div class="row tools">
                <div class="col-sm-2">
                    <div class="tool radius">
                        <div class="overlayCountries noPointer" id="hudButtons">
                            <h5>Country</h5>
                            <input type="name" name="country" class="countryTextInput form-control pointer noMapDrag" value="UNITED STATES">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="tool coordinates">
                        <h5>Country 2</h5>
                        <input type="name" step="any" id="coordinates-lng" class="form-control" placeholder="Country2">
                        <!--  <input type="number" step="any" id="coordinates-lat" class="form-control" placeholder="Latitude"> -->
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="tool coordinates">
                        <h5>Commodity</h5>
                        <input type="name" step="any" id="coordinates-lng" class="form-control" placeholder="Commodity">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="tool timeframe">
                        <h5>Start Time</h5>
                        <input type="date" id="timeframe-start" class="form-control" placeholder="mm/dd/yyyy">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="tool timeframe">
                        <h5>End time</h5>
                        <span id="countryText" class="country">
                        <input type="date" id="timeframe-end" class="form-control" placeholder="mm/dd/yyyy">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="tool">
                        <h5>Commodity Trade Flow </h5>
                     
                        <i type="button" id="refresh" class="btn fa fa-refresh fa-3"></i>
                     


                    </div>
                </div>

            </div>
        </form>
    </div>
   <!--  <div style="margin-bottom: 5rem;"></div> -->
    <div id="wrapper" class="row">
        
               <div id="loading">
                                <h2>Loading...</h2>
                            </div>
            
                    <div id="visualization">

                        <!-- 2D overlay elements go in here -->
                        <div id="app-maparea" style="background-color: ;" class="col-md-8">
                          

                         
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        
                        <div id="glContainer" style="max-height: 10rem;">

                            <!-- 3D webgl canvas here -->
                        </div>
                        <!-- </canvas> -->
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
               
                        <i type="button" style="cursor: pointer; color: white;" class="fa fa-search-plus fa-3 zoomBtn zoomInBtn armsBtn pointer noMapDrag" aria-hidden="true" ></i>
                        <i type="button" style="cursor: pointer; color: white;" class="fa fa-search-minus fa-3 zoomBtn zoomOutBtn armsBtn pointer noMapDrag" aria-hidden="true" ></i>

                    <div class="panel medium-panel  animated zoomIn" style="color:white;background-color: #00000080; z-index: -3;
                                        border: none;
                                       
                                        border-radius: 5px;
                                        position: relative;
                                        margin-bottom: 24px;
                                        margin-top: -2rem;
                                        margin-left: -4rem;
                                        box-shadow: 0 5px 5px 0 rgba(0, 0, 0, 0.25);
                                            height: 40rem;" zoom-in=""> 

                     
                    <table id="marker_template" class="marker" style="left:-60rem !important;top:0px;font-weight: 1px;color: white;">
                    <tr>
                    <td><span id="countryText" class="country">
                        </span>
                        </td>
                        <td class="detail" id="detailText">
                            <span id="detailText" class="detail"></span>
                        </td>
                        </tr>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="panel medium-panel col-sm-12 col-md-12 animated zoomIn" style="color:white;background-color: #00000080;
                                z-index: -3;
                                        border: none;
                                       
                                        border-radius: 5px;
                                        position: relative;
                                        margin-bottom: 24px;
                                        margin-left: -1rem;
                                        box-shadow: 0 5px 5px 0 rgba(0, 0, 0, 0.25);
                                            height: 40rem;" zoom-in="">
                        <style>
                        #chart svg {
                            height: 400px;
                        }
                        </style>
                        <div id="chart">
                            <svg></svg>
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
            <script src="js/jquery-1.7.1.min.js"></script>
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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
            <!-- <script src="js/d3.v2.min.js"></script> -->
            <script src="js/ui.controls.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.5/nv.d3.js"></script>
            <script type="text/javascript" src="nvd3ex.js"></script>
            <div class="globe" style="max-height: 10rem; max-width: 10rem;">
                <script src="js/main.js" type="text/javascript"></script>
                <script type="text/javascript">
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
            </div>
            <!-- All other hud can go here-->
            <!-- <div id="hudHeader" class="overlayCountries noPointer">
    <h1 class="noPointer">Small Arms and Ammunition — Imports & Exports
                <div class="subtitle">An interactive visualization of government-authorized small arms and ammunition transfers from 1992 to 2010. </div>
            </h1>
</div>
 -->
            <div id="history" class="overlayCountries noPointer">
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
                    <li>92</li>
                    <li>93</li>
                    <li>94</li>
                    <li>95</li>
                    <li>96</li>
                    <li>97</li>
                    <li>98</li>
                    <li>99</li>
                    <li>2000</li>
                    <li>01</li>
                    <li>02</li>
                    <li>03</li>
                    <li>04</li>
                    <li>05</li>
                    <li>06</li>
                    <li>07</li>
                    <li>08</li>
                    <li>09</li>
                    <li>2010</li>
                    <div id="handle" class="noMapDrag"></div>
                </ul>
            </div>
            <div id="graphIcon" class="overlayCountries"></div>
            <div id="importExportBtns" class="overlayCountries">
                <div class="typeLabels">
                    <div class="mil">Banana</div>
                    <div class="civ">OIL</div>
                    <div class="ammo">Gold</div>
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
                    <div class="label">Imports</div>
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
                    <div class="label">Exports</div>
                    <br class="clear">
                </div>
                <br class="clear" />
            </div>
            <div class="overlayCountries">
            </div>
            <div id="aboutContainer" class='overlayCountries'>
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
canvas {
    margin-left: -25rem;
    max-width: 80rem;
    margin-top: 10rem;
}

#history {
    position: absolute;
    bottom: 0;
    left: 386px;
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
    left: 642px;
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
        height: 40rem;
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

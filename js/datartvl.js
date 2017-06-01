function titleCase(str) {
    return str.split(' ').map(function(val) {
        return val.charAt(0).toUpperCase() + val.substr(1).toLowerCase();
    }).join(' ');
};

function displayFormData() {
    var inObj = new Object();
    inObj.direction = document.getElementById("direction").value;

    inObj.commodity = document.getElementById("commodity").value;
    inObj.reporter = document.getElementById("reporter").value;
    inObj.partner = document.getElementById("partner").value;
    if(inObj.reporter == inObj.partner && inObj.reporter != "" ){
        alert("Please select different countries");
        return;
    }
    if(inObj.direction == ""){
        alert("Please select the direction option");
        return;
    }
    if(inObj.reporter== "" && inObj.partner =="" && inObj.commodity == ""){
        alert("Please select commodity or country for analysing trade");
        return;   
    }

    var msg = "Direction: " + document.getElementById("direction").value + "\nCommodity: " + document.getElementById("commodity").value + "\n Importer: " + document.getElementById("reporter").value + "\n Exporter: " + document.getElementById("partner").value;

    console.log(inObj.direction);



    return inObj;
};


function grpahCreation(val1,val2){
    
    var input = displayFormData();
    
    //alert("input country "+input.reporter+"  partner "+input.partner);
    //alert(val1+" graph "+val2);
    //var yr_val = "2013"; //selectionData.selectedYear;
    var yr_val = selectionData.selectedYear;
    console.log(yr_val);
    if (input.direction == "Exports") {


        console.log("calling for exports ");
        
        readTextFile("./data_pre/exportData.json", function(text) {
            var data = JSON.parse(text);
            //console.log(data);
            // case 1
            var array;
            var countries ;//= [];
            var year_arr = ["2011", "2012", "2013", "2014", "2015"];
            var countriesValue ;//= [];
            if (input.partner == "" && input.reporter != "" && input.commodity != "") {
                //All Imports: for given Country + Year
                console.log("case 1");
                countries = [];
                countriesValue = [];
                var key = input.reporter + "" + yr_val;
                array = [];
                for (var i = 0; i < data[key].length; i++) {
                    var temp = {};
                    if (data[key][i].commodity == input.commodity) {
                        temp.value = data[key][i].val;
                        temp.country = data[key][i].country;
                        array.push(temp);
                        countries.push(temp.country);
                        countriesValue.push(temp.value);
                    }
                }
                console.log(array);
                var selectedCommodity = input.commodity;
                var allCommodities = ['Coffee', 'Copper', 'Corn', 'Cotton', 'Crude Oil', 'Gold', 'Silver', 'Sugar', 'Wheat'];
                drawbargrph(countries,input.commodity, countriesValue,"Export Partners for "+input.reporter,val1,val2);
                console.log('generating globe for case1');
                imade(selectionData.selectedYear, [input.reporter], [selectedCommodity]);
                //imade(selectionData.selectedYear, [input.reporter], [titleCase(input.commodity)], [titleCase(input.commodity)]);
            } else if (input.partner != "" && input.reporter != "" && input.commodity != "") { // case two : partner is selected
                console.log("case 2");
                var key1 = input.reporter + "2011";
                var key2 = input.reporter + "2012";
                var key3 = input.reporter + "2013";
                var key4 = input.reporter + "2014";
                var key5 = input.reporter + "2015";
                var arr = [key1, key2, key3, key4, key5];
                var year_arr = ["2011", "2012", "2013", "2014", "2015"];
                array = [];
                var allYrs = [];
                var yearsvalue = [];
                for (var key = 0; key < arr.length; key++) {
                    if (data[arr[key]] == null) {
                        console.log("no import");
                        continue;
                    }
                    
                    for (var i = 0; i < data[arr[key]].length; i++) {
                        var temp = {};

                        if (data[arr[key]][i].commodity == input.commodity && data[arr[key]][i].country == input.partner) {
                            //alert(year_arr[key]+" "+data[arr[key]][i].val);
                            temp.year = year_arr[key];
                            temp.value = data[arr[key]][i].val;
                            temp.reporter = input.reporter;
                            temp.partner = input.partner;
                            array.push(temp);
                            allYrs.push(temp.year);
                            yearsvalue.push(temp.value);

                        }
                    }
                }
                console.log(array);
               // alert(allYrs+" val "+yearsvalue);
                if(allYrs.length == 0){
                    allYrs = year_arr;
                    yearsvalue = [0,0,0,0,0];   
                }
                var allCommodities = ['Coffee', 'Copper', 'Corn', 'Cotton', 'Crude Oil', 'Gold', 'Silver', 'Sugar', 'Wheat'];
                var selectedCommodity = input.commodity;
                console.log('generating globe for case2');
                drawbargrph(allYrs, selectedCommodity, yearsvalue,"Historical Export Trends "+input.reporter+"->"+input.partner,val1,val2);
                imade(selectionData.selectedYear, [input.reporter], [selectedCommodity], allCommodities);
                // selectedCountry = input.reporter;
                // console.log(selectedCountry.summary.imported.total);
                
                // document.getElementById("piechart").style.visibility = "hidden";

            } else if (input.commodity == "" && input.reporter != "" && input.partner != "") {
                console.log("case 3");
                var key = input.reporter + "" + yr_val;
                array = [];
                //except natural gas 

                var countryCommodities = [];
                var countryValues = [];
                for (var i = 0; i < data[key].length; i++) {
                    var temp = {};
                    if (data[key][i].country == input.partner) {
                        temp.value = data[key][i].val;
                        temp.commodity = data[key][i].commodity;
                        array.push(temp);
                        countryCommodities.push(temp.commodity);
                        countryValues.push(temp.value);


                    }
                }
                console.log(selectionData.selectedYear);
                
                console.log('generating globe for case3');
                drawPiegrph(countryCommodities, countryValues, 1);
                imade(selectionData.selectedYear, [input.reporter], allCommodities, allCommodities);
                console.log(countryValues);
//                if(countryCommodities.length==0){
//                    alert(" no commodity is traded between the countries");
//                    return;
//                }
               // alert(" commodties : "+countryCommodities+"  value "+countryValues);
                
                // document.getElementById("m").style.visibility = "hidden";

                //alert(array.length);

            } else if (input.commodity == "" && input.reporter != "" && input.partner == "") {
                console.log("case 4");
                var key = input.reporter + "" + yr_val;
                array = [];
                var arr_k = {};
                var commodities = [];
                var commoditiesValues = [];
                
                for (var i = 0; i < data[key].length; i++) {
                    var temp = [];
                    temp.value = data[key][i].val;
                    var nt_val = data[key][i].val;
                    var commodity = data[key][i].commodity;
                    if (arr_k.hasOwnProperty(commodity)) {
                        arr_k[commodity]["value"] = arr_k[commodity]["value"] + nt_val;
                    } else {
                        arr_k[commodity] = {};
                        arr_k[commodity]["commodity"] = commodity;
                        arr_k[commodity]["value"] = nt_val;
                    }
                    //commoditiesValues.push(temp.value);
                }
                
                for (var key1 in arr_k) {
                    commodities.push(key1);
                    var lvalue = arr_k[key1];
                    commoditiesValues.push(arr_k[key1]["value"]);
                }
                drawPiegrph(commodities, commoditiesValues, 1);
                var allCommodities = ['Coffee', 'Copper', 'Corn', 'Cotton', 'Crude Oil', 'Gold', 'Silver', 'Sugar', 'Wheat'];
                imade(selectionData.selectedYear, [input.reporter], allCommodities, allCommodities);
                //alert(array.length);
            } else if (input.commodity != "" && input.reporter == "" && input.partner == "" && input.direction != "") {

                // ============= for a single commodity we are showing diiferent country either expor 
                // or imort contribution for every year
                console.log("case 5");

                var countrylist = ["brazil", "canada", "china", "france", "japan", "india", "mexico", "russia", "uk", "us"];
                var array_spiral = [];
                for (var cont = 0; cont < countrylist.length; cont++) {

                    var key1 = countrylist[cont] + "2011";
                    var key2 = countrylist[cont] + "2012";
                    var key3 = countrylist[cont] + "2013";
                    var key4 = countrylist[cont] + "2014";
                    var key5 = countrylist[cont] + "2015";
                    var arr = [key1, key2, key3, key4, key5];
                    var year_arr = ["2011", "2012", "2013", "2014", "2015"];

                    for (var key = 0; key < arr.length; key++) {
                        if (data[arr[key]] == null) {
                            console.log("no import");
                            continue;
                        }
                        var val = 0;
                        for (var i = 0; i < data[arr[key]].length; i++) {
                            if (data[arr[key]][i].commodity == input.commodity) {
                                //alert(year_arr[key]+" "+data[arr[key]][i].val);
                                val = val + data[arr[key]][i].val;
                            }
                        }
                        array_spiral.push(val);
                    }

                }
                drawSpiralHeatMap(array_spiral);

                // ==============
            }
            console.log("year : " + selectionData.selectedYear);
            console.log(commodities);
            var allCommodities = ['Coffee', 'Copper', 'Corn', 'Cotton', 'Crude Oil', 'Gold', 'Silver', 'Sugar', 'Wheat'];
            imade(selectionData.selectedYear, [input.reporter], allCommodities, allCommodities);
            //alert(array.length);
            return array;

        });

    } else {

        console.log("calling for imports ");
        readTextFile("./data_pre/importData.json", function(text) {
            var data = JSON.parse(text);
            //console.log(data);
            // case 1
            var array;
            if (input.partner == "" && input.reporter != "" && input.commodity != "") {
                //All Imports: for given Country + Year
                console.log("inside displayJson");
                var key = input.reporter + "" + yr_val;
                array = [];
                var countries = [];
                var year_arr = ["2011", "2012", "2013", "2014", "2015"];
                var countriesValue = [];

                for (var i = 0; i < data[key].length; i++) {
                    var temp = {};
                    if (data[key][i].commodity == input.commodity) {
                        temp.value = data[key][i].val;
                        temp.country = data[key][i].country;
                        countries.push(temp.country);
                        countriesValue.push(temp.value);
                        array.push(temp);
                    }
                }
                console.log(titleCase(input.commodity));
                drawbargrph(countries,input.commodity, countriesValue,"Import Partners for "+input.reporter,val1,val2);
                console.log('generating globe for case1');
                imade(selectionData.selectedYear, [input.reporter], [titleCase(input.commodity)], [titleCase(input.commodity)]);
            } else if (input.partner != "" && input.reporter != "" && input.commodity != "") { // case two : partner is selected
                console.log("case 2");
                var key1 = input.reporter + "2011";
                var key2 = input.reporter + "2012";
                var key3 = input.reporter + "2013";
                var key4 = input.reporter + "2014";
                var key5 = input.reporter + "2015";
                var arr = [key1, key2, key3, key4, key5];
                var year_arr = ["2011", "2012", "2013", "2014", "2015"];
                array = [];
                var allYrs = [];
                var yearsvalue = [];
                for (var key = 0; key < arr.length; key++) {
                    if (data[arr[key]] == null) {
                        console.log("no import");
                        continue;
                    }
                    for (var i = 0; i < data[arr[key]].length; i++) {
                        var temp = {};
                        if (data[arr[key]][i].commodity == input.commodity && data[arr[key]][i].country == input.partner) {
                            //alert(year_arr[key]+" "+data[arr[key]][i].val);
                            temp.year = year_arr[key];
                            temp.value = data[arr[key]][i].val;
                            temp.reporter = input.reporter;
                            temp.partner = input.partner;
                            array.push(temp);
                            allYrs.push(temp.year);
                            yearsvalue.push(temp.value);
                        }
                    }
                }
                console.log(array);
                if(allYrs.length == 0){
                    allYrs = year_arr;
                    yearsvalue = [0,0,0,0,0];   
                }
                var allCommodities = ['Coffee', 'Copper', 'Corn', 'Cotton', 'Crude Oil', 'Gold', 'Silver', 'Sugar', 'Wheat'];
                var selectedCommodity = input.commodity;
                console.log('generating globe for case2');
                drawbargrph(allYrs, selectedCommodity, yearsvalue,"Historical Imports Trends "+input.reporter+" -> "+input.partner,val1,val2);
                imade(selectionData.selectedYear, [input.reporter], [selectedCommodity], allCommodities);
                // selectedCountry = input.reporter;
                // console.log(selectedCountry.summary.imported.total);
                
                // document.getElementById("piechart").style.visibility = "hidden";


            } else if (input.commodity == "" && input.reporter != "" && input.partner != "") {
                console.log("case 3");
                var key = input.reporter + "" + yr_val;
                array = [];
                var countryCommodities = [];
                var countryValues = [];
                for (var i = 0; i < data[key].length; i++) {
                    var temp = {};
                    if (data[key][i].country == input.partner) {
                        temp.value = data[key][i].val;
                        temp.commodity = data[key][i].commodity;
                        array.push(temp);
                        countryCommodities.push(temp.commodity);
                        countryValues.push(temp.value);


                    }
                }

                console.log(selectionData.selectedYear);
                var allCommodities = ['Coffee', 'Copper', 'Corn', 'Cotton', 'Crude Oil', 'Gold', 'Silver', 'Sugar', 'Wheat'];
                console.log('generating globe for case3');
                drawPiegrph(countryCommodities, countryValues, 1);
                imade(selectionData.selectedYear, [input.reporter], allCommodities, allCommodities);
                console.log(countryValues);
//                if(countryCommodities.length==0){
//                    alert(" no commodity is traded between the countries");
//                    return;
//                }
                
                //alert(array.length);

            } else if (input.commodity == "" && input.reporter != "" && input.partner == "") {
                console.log("case 4");
                var key = input.reporter + "" + yr_val;
                array = [];
                var arr_k = {};
                var commodities = [];
                var commoditiesValues = [];
                for (var i = 0; i < data[key].length; i++) {
                    var temp = [];
                    temp.value = data[key][i].val;
                    var nt_val = data[key][i].val;
                    var commodity = data[key][i].commodity;
                    if (arr_k.hasOwnProperty(commodity)) {
                        arr_k[commodity]["value"] = arr_k[commodity]["value"] + nt_val;
                    } else {

                        arr_k[commodity] = {};
                        arr_k[commodity]["commodity"] = commodity;
                        arr_k[commodity]["value"] = nt_val;
                    }
                    
                }
                for (key1 in arr_k) {
                    commodities.push(key1);
                    var lvalue = arr_k[key1];
                    commoditiesValues.push(arr_k[key1]["value"]);
                }
                //alert(" commodties : "+countryCommodities+"  value "+countryValues);
                drawPiegrph(commodities, commoditiesValues, 1);
                var allCommodities = ['Coffee', 'Copper', 'Corn', 'Cotton', 'Crude Oil', 'Gold', 'Silver', 'Sugar', 'Wheat'];
                imade(selectionData.selectedYear, [input.reporter], allCommodities, allCommodities);
                //alert(array.length);
            } else if (input.commodity != "" && input.reporter == "" && input.partner == "" && input.direction != "") {

                // ============= for a single commodity we are showing diiferent country either expor 
                // or imort contribution for every year
                console.log("case 5");
                var countrylist = ["brazil", "canada", "china", "france", "japan", "india", "mexico", "russia", "uk", "us"];
                var array_spiral = [];
                var max = 0;
                var min = 10000000;
                for (var cont = 0; cont < countrylist.length; cont++) {

                    var key1 = countrylist[cont] + "2011";
                    var key2 = countrylist[cont] + "2012";
                    var key3 = countrylist[cont] + "2013";
                    var key4 = countrylist[cont] + "2014";
                    var key5 = countrylist[cont] + "2015";
                    var arr = [key1, key2, key3, key4, key5];
                    var year_arr = ["2011", "2012", "2013", "2014", "2015"];

                    for (var key = 0; key < arr.length; key++) {
                        if (data[arr[key]] == null) {
                            console.log("no import");
                            continue;
                        }
                        var val = 0;
                        for (var i = 0; i < data[arr[key]].length; i++) {
                            if (data[arr[key]][i].commodity == input.commodity) {
                                //alert(year_arr[key]+" "+data[arr[key]][i].val);
                                val = val + data[arr[key]][i].val;
                            }
                        }
                        if(val< min){
                            min = val;
                        }
                        if(val > max){
                            max = val;
                        }
                        array_spiral.push(val);
                    }

                }
               // alert(array_spiral);
                drawSpiralHeatMap(array_spiral,max,min);

                // ==============
            }
            console.log("year : " + selectionData.selectedYear);
            console.log(array);
            var allCommodities = ['Coffee', 'Copper', 'Corn', 'Cotton', 'Crude Oil', 'Gold', 'Silver', 'Sugar', 'Wheat'];
            imade(selectionData.selectedYear, [input.reporter], allCommodities, allCommodities);
            //alert(array.length);
            return array;

        });
    } 
}


function displayJSON() {
    
    var svg = d3.select("#chart svg");
    svg.select("*").remove();
    
    var ctx2 = document.getElementById("doughnut").getContext('2d');
    var count = document.getElementById("reporter").value;
    var yr = selectionData.selectedYear;
    var key1 = "export_"+count+""+yr;
    var key2 = "import_"+count+""+yr;
    var val1 = 0;
    var val2 = 0;
    readTextFile("./data_pre/donData.json", function(text) {
                var data = JSON.parse(text);
                val1 = data[key1];
                val2 = data[key2];
                grpahCreation(val1,val2);

    });
    
} // the displayJson fucntion completed over here

function readTextFile(file, callback) {
    var rawFile = new XMLHttpRequest();
    rawFile.overrideMimeType("application/json");
    rawFile.open("GET", file, true);
    rawFile.onreadystatechange = function() {
        if (rawFile.readyState === 4 && rawFile.status == "200") {
            callback(rawFile.responseText);
        }
    }
    rawFile.send(null);
}

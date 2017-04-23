 function displayFormData() {
     var inObj = new Object();
     inObj.direction = document.getElementById("direction").value;
     inObj.commodity = document.getElementById("commodity").value;
     inObj.reporter = document.getElementById("reporter").value;
     inObj.partner = document.getElementById("partner").value;

     var msg = "Direction: " + document.getElementById("direction").value + "\nCommodity: " + document.getElementById("commodity").value + "\n Importer: " + document.getElementById("reporter").value + "\n Exporter: " + document.getElementById("partner").value;

     console.log(inObj.direction);



     return inObj;
 }

 function displayJSON() {
     var input = displayFormData();

     //var yr_val = "2013"; //selectionData.selectedYear;
     var yr_val = selectionData.selectedYear;
     console.log(yr_val);

     if (input.direction == "Exports") {


         console.log("calling for exports ");
         readTextFile("./data_pre/Data.json", function(text) {
             var data = JSON.parse(text);
             //console.log(data);
             // case 1
             var array;
             if (input.partner == "" && input.reporter != "" && input.commodity != "") {
                 //All Imports: for given Country + Year
                 console.log("inside displayJson");
                 var key = input.reporter + "" + yr_val;
                 array = [];
                 for (var i = 0; i < data[key].length; i++) {
                     var temp = {};
                     if (data[key][i].commodity == input.commodity) {
                         temp.value = data[key][i].val;
                         temp.country = data[key][i].country;
                         array.push(temp);
                     }
                 }
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
                 for (var key = 0; key < arr.length; key++) {
                     if (data[arr[key]] == null) {
                         console.log("no import");
                         continue;
                     }
                     var allYrs = [];
                     var yearsvalue = [];
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
                 var allCommodities = ['Coffee', 'Copper', 'Corn', 'Cotton', 'Crude Oil', 'Gold', 'Silver', 'Sugar', 'Wheat'];
                 var selectedCommodity = input.commodity
                 imade(selectionData.selectedYear, [input.reporter], [selectedCommodity], allCommodities);
                 // selectedCountry = input.reporter;
                 // console.log(selectedCountry.summary.imported.total);
                 drawbargrph(year_arr, selectedCommodity, yearsvalue);
                 document.getElementById("piechart").style.visibility = "hidden";

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
                 var allCommodities = ['Coffee', 'Copper', 'Corn', 'Cotton', 'Crude Oil', 'Gold', 'Silver', 'Sugar', 'Wheat'];
                 imade(selectionData.selectedYear, [input.reporter], allCommodities, allCommodities);
                 console.log(countryValues);
                 drawPiegrph(countryCommodities, countryValues, 1);
                 //alert(array.length);

             } else if (input.commodity == "" && input.reporter != "" && input.partner == "") {
                 console.log("case 4");
                 var key = input.reporter + "" + yr_val;
                 array = [];
                 arr_k = {};
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
                     var lvalue = arr_k[key1];
                     array.push(arr_k[key1]);
                 }
                 //alert(array.length);
             }
             console.log("year : " + selectionData.selectedYear);
             console.log(array);


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
                 for (var i = 0; i < data[key].length; i++) {
                     var temp = {};
                     if (data[key][i].commodity == input.commodity) {
                         temp.value = data[key][i].val;
                         temp.country = data[key][i].country;
                         array.push(temp);
                     }
                 }
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
                         }
                     }
                 }

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

                 console.log(countryValues);
                 drawPiegrph(countryCommodities, countryValues, 1);
                 //alert(array.length);

             } else if (input.commodity == "" && input.reporter != "" && input.partner == "") {
                 console.log("case 4");
                 var key = input.reporter + "" + yr_val;
                 array = [];
                 arr_k = {};
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
                     var lvalue = arr_k[key1];
                     array.push(arr_k[key1]);
                 }
                 //alert(array.length);
             }
             console.log("year : " + selectionData.selectedYear);
             console.log(array);


             //alert(array.length);
             return array;

         });



     }


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



import threading
import urllib2
import time, json
import requests
import os.path

#"284330,150810,09,1109,52,071040,17,28432,7406"

countrylist = ["brazil","canada","china","france","japan","india","mexico","russia","uk","us"]
yrs = ["2011","2012","2013","2014","2015"]
dataTable ={"284330":"Gold","150810":"crude","09":"coffee","1109":"wheat","52":"cotton","071040":"corn","17":"sugar","28432":"silver","7406":"copper","271111":"natural gas"};
file_list = []
start = time.time()
#final data identifier


resData = {}
final_1 = "importData.json"
with open(final_1, 'r') as json_data:
    data_json = json.load(json_data)
    for i in countrylist:
        for k in yrs:
            key = i+""+k
            key1 = "import_"+key
            val = 0
            for ind in range(0,len(data_json[key])):
                val = val + data_json[key][ind]["val"]
            resData[key1] = val

finale_2 ="exportData.json"
with open(finale_2, 'r') as json_data:
    data_json = json.load(json_data)
    for i in countrylist:
        for k in yrs:
            key = i+""+k
            key1 = "export_"+key
            for ind in range(0,len(data_json[key])):
                val = val + data_json[key][ind]["val"]
            resData[key1] = val
print resData       
    
final_file_name = "donData.json"
if not os.path.isfile("./"+final_file_name):
    with open(final_file_name, 'w') as outfile:
        json.dump(resData, outfile)
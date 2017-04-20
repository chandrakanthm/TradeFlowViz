

import threading
import urllib2
import time, json
import requests
import os.path

#"284330,150810,09,1109,52,071040,17,28432,7406"

countrylist = ["brazil","canada","china","france","japan","india","mexico","russia","uk","us"]
yrs = ["2011","2012","2013","2014","2015"]
dataTable ={"284330":"Gold","150810":"crude","09":"coffee","1109":"wheat","52":"cotton","071040":"corn","17":"sugar","28432":"silver","7406":"copper"};
file_list = []
start = time.time()
urls = ["http://comtrade.un.org/api/get?max=50000&type=C&freq=A&px=HS&ps=2015,2014,2013,2012,2011&r=all&p=76&rg=all&cc=284330,150810,09,1109,52,071040,17,28432,7406&fmt=json",
       "http://comtrade.un.org/api/get?max=50000&type=C&freq=A&px=HS&ps=2015,2014,2013,2012,2011&r=all&p=124&rg=all&cc=284330,150810,09,1109,52,071040,17,28432,7406&fmt=json",
       "http://comtrade.un.org/api/get?max=50000&type=C&freq=A&px=HS&ps=2015,2014,2013,2012,2011&r=all&p=156&rg=all&cc=284330,150810,09,1109,52,071040,17,28432,7406&fmt=json",
       "http://comtrade.un.org/api/get?max=50000&type=C&freq=A&px=HS&ps=2015,2014,2013,2012,2011&r=all&p=251&rg=all&cc=284330,150810,09,1109,52,071040,17,28432,7406&fmt=json",
       "http://comtrade.un.org/api/get?max=50000&type=C&freq=A&px=HS&ps=2015,2014,2013,2012,2011&r=all&p=392&rg=all&cc=284330,150810,09,1109,52,071040,17,28432,7406&fmt=json",
       "http://comtrade.un.org/api/get?max=50000&type=C&freq=A&px=HS&ps=2015,2014,2013,2012,2011&r=all&p=699&rg=all&cc=284330,150810,09,1109,52,071040,17,28432,7406&fmt=json",
       "http://comtrade.un.org/api/get?max=50000&type=C&freq=A&px=HS&ps=2015,2014,2013,2012,2011&r=all&p=484&rg=all&cc=284330,150810,09,1109,52,071040,17,28432,7406&fmt=json",
       "http://comtrade.un.org/api/get?max=50000&type=C&freq=A&px=HS&ps=2015,2014,2013,2012,2011&r=all&p=643&rg=all&cc=284330,150810,09,1109,52,071040,17,28432,7406&fmt=json",
       "http://comtrade.un.org/api/get?max=50000&type=C&freq=A&px=HS&ps=2015,2014,2013,2012,2011&r=all&p=826&rg=all&cc=284330,150810,09,1109,52,071040,17,28432,7406&fmt=json",
       "http://comtrade.un.org/api/get?max=50000&type=C&freq=A&px=HS&ps=2015,2014,2013,2012,2011&r=all&p=834&rg=all&cc=284330,150810,09,1109,52,071040,17,28432,7406&fmt=json"]


def fetch_url(url, i):
    file_name = "import_file_"+countrylist[i]+".json"
    file_list.append(file_name)
    response = requests.get(url, verify=False)
    data = response.json()
    if not os.path.isfile("./"+file_name):
        with open(file_name, 'w') as outfile:
            json.dump(data["dataset"], outfile)
        print "'%s\' fetched in %ss" % (url, (time.time() - start))
    
threads = [threading.Thread(target=fetch_url, args=(urls[i],i,)) for i in range(0,len(urls)) ]
for thread in threads:
    thread.start()
    time.sleep(12)
for thread in threads:
    thread.join()
    
#final data identifier
res_data = {}
for k in range(0,len(countrylist)):
    with open(file_list[k],"r") as json_data:
        data_json = json.load(json_data)
        for j in range(0,len(data_json)):  
            if data_json[j]['yr'] == 2011:
                a = (countrylist[k],"2011")
            elif data_json[j]['yr'] == 2012:
                a = (countrylist[k],"2012")
            elif data_json[j]['yr'] == 2013:
                a = (countrylist[k],"2013")
            elif data_json[j]['yr'] == 2014:
                a = (countrylist[k],"2014")
            elif data_json[j]['yr'] == 2015:
                a = (countrylist[k],"2015")
            # insrt the key
            a = "".join(a)
            if a not in res_data.keys():
                res_data[a] = []
            if data_json[j]["rtTitle"].lower() not in countrylist:
                continue
            b = (data_json[j]["rtTitle"],dataTable[str(data_json[j]["cmdCode"])])
            res_data[a].append(b)


final_file_name = "export_final_json"
if not os.path.isfile("./"+final_file_name):
    with open(final_file_name, 'w') as outfile:
        json.dump(res_data, outfile)
    
    
#for i in range(0,len(file_list)):
    
    
print "Elapsed Time: %s" % (time.time() - start)
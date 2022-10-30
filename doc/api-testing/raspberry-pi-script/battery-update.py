#!/usr/bin/python3
from pijuice import PiJuice # Import pijuice module
from datetime import date
import json
import os

keyfile = '/home/pi/cargps-script/access.key';
pijuice = PiJuice(1, 0x14) # Instantiate PiJuice interface object
link = 'http://magian-ltd.com/cargps/api/gpsapi/batterystatus'
key = ''
curl_cmd_1 = 'curl -X POST -H "Content-Type: application/json" -H "Authorization:'
today = date.today()

cur_dt = today.strftime("%Y-%m-%d")

#print(pijuice.status.GetStatus()) # Read PiJuice status.
#ch_object = json.loads(pijuice.status.GetChargeLevel())
#print (ch_object["data"])
ob = (pijuice.status.GetChargeLevel())
#print (str(ob["data"]) + '%') 

f = open(keyfile,"r")
key = f.readline()
f.close()
key = key.replace('\n','')

#print(curl_cmd_1 + key + "\" -d '{\"battery\":\""+str(ob["data"])+"%\"}' "+link)
os.system(curl_cmd_1 + key + "\" -d '{\"battery\":\""+str(ob["data"])+"%\"}' "+link+" >> /home/pi/cargps-script/log/"+cur_dt+".log")
os.system("echo \"\n\" >> /home/pi/cargps-script/log/"+cur_dt+".log")


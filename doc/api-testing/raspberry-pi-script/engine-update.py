#!/usr/bin/python3
from pijuice import PiJuice # Import pijuice module
from datetime import date
import json
import os

keyfile = '/home/pi/cargps-script/access.key';
pijuice = PiJuice(1, 0x14) # Instantiate PiJuice interface object
link = 'http://magian-ltd.com/cargps/api/gpsapi/engine'
key = ''
curl_cmd_1 = 'curl -X POST -H "Content-Type: application/json" -H "Authorization:'
today = date.today()
no_ac_power_key = 'NOT_PRESENT'
engine = ''

cur_dt = today.strftime("%Y-%m-%d")

ob = pijuice.status.GetStatus() # Read PiJuice status.
if ob["data"]["powerInput"] == no_ac_power_key and ob["data"]["powerInput5vIo"] == no_ac_power_key:
    engine = 'offline'
else:
    engine = 'online'

f = open(keyfile,"r")
key = f.readline()
f.close()
key = key.replace('\n','')

#print(curl_cmd_1 + key + "\" -d '{\"engine\":\""+engine+"\"}' "+link)
os.system(curl_cmd_1 + key + "\" -d '{\"engine\":\""+engine+"\"}' "+link+" >> /home/pi/cargps-script/log/"+cur_dt+".log")
os.system("echo \"\n\" >> /home/pi/cargps-script/log/"+cur_dt+".log")


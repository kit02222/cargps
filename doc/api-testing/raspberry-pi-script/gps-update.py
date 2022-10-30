from gps import *
from datetime import date
import threading
import os
import json
import simplejson

keyfile = '/home/pi/cargps-script/access.key'
link = 'http://magian-ltd.com/cargps/api/gpsapi/gpsinfo'
key = ''
curl_cmd_1 = 'curl -X POST -H "Content-Type: application/json" -H "Authorization: '
cur_dt = date.today().strftime("%Y-%m-%d")
logfile = '/home/pi/cargps-script/log/'+cur_dt+'.log'
gpsd = None

class GpsPoller(threading.Thread):
    def __init__(self):
        threading.Thread.__init__(self)
        global gpsd
        gpsd=gps(mode=WATCH_ENABLE)
        self.current_value = None
        self.running = True
    def run(self):
        global gpsd
        #while gpsp.running:
        if gpsp.running :
            gpsd.next()

if __name__ == "__main__":
    gpsp=GpsPoller()

    try:
        gpsp.start()

        #while True:
        print("------GPS INFO------")
        print("longitude:   "+str(gpsd.fix.longitude))
        print("latitiude:   "+str(gpsd.fix.latitude))
        print("time utc:    "+str(gpsd.utc)+" "+str(gpsd.fix.time))
        print("altitude(m): "+str(gpsd.fix.altitude))
        print("speed(m/s):  "+str(gpsd.fix.speed))
        #print("status:      "+str(gpsd.fix.status))
        #print("heading:     "+str(gpsd.fix.heading))
        print("climb:       "+str(gpsd.fix.climb))
        print(vars(gpsd.fix))
        print("------")
        print("")

        if gpsd.fix.longitude != 0 and gpsd.fix.latitude != 0 :
            #print(json.dumps(gpsd.fix.__dict__))
            f = open(keyfile,"r")
            key = f.readline()
            f.close()
            key = key.replace('\n','')
        
            #json_str = json.dumps(gpsd.fix.__dict__) 
            json_str = simplejson.dumps(gpsd.fix.__dict__,ignore_nan=True)
            #print(curl_cmd_1 + key +"\" -d '"+json_str+"' "+link+" >> "+logfile)
        
            os.system(curl_cmd_1 + key + "\" -d '" + json_str+"' "+link+" >> "+logfile)
            os.system("echo \"\n\" >> "+logfile)
            #time.sleep(30)

    except(KeyboardInterrupt,SystemExit):
       gpsp.running = False
       gpsp.join()



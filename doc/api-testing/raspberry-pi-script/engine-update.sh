#!/bin/bash
key='/root/cargps-script/access.key'
link='http://magian-ltd.com/cargps/api/gpsapi/engine'
curl_cmd_1='curl -X POST -H "Content-Type: application/json" -H "Authorization:'
curl_cmd_2="\" -d '{\"engine\":\"$1\"}' "
logfile=/root/cargps-script/log/$(date '+%Y-%m-%d').log

while IFS= read line
do
	eval	"$curl_cmd_1 $line$curl_cmd_2 $link >> $logfile"
done < "$key"
eval "echo \"\n\" >> $logfile"


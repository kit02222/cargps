#$mydomain = "amuse-bar.com"
#$myhostname = "@"
#$gdapikey = "Aa6sCs4vShg_GTUZr6WJtA3QaP4WgqKY1p:QqEyEJNpU1tV7Kn66sMArQ"

#$myip = Invoke-RestMethod -Uri "https://api.ipify.org"
#$dnsdata = Invoke-RestMethod "https://api.godaddy.com/v1/domains/$($mydomain)/records/A/$($myhostname)" -Headers @{ Authorization = "sso-key $($gdapikey)" }
#$gdip = $dnsdata.data
#Write-Output "$(Get-Date -Format 'u') - Current External IP is $($myip), GoDaddy DNS IP is $($gdip)"

#If ( $gdip -eq $myip){
# Write-Output "Same IP!!No need to update on GoDaddy"
#}else{
#  Write-Output "IP has changed!! Updating on GoDaddy"
#  Invoke-RestMethod -Method PUT -Uri "https://api.godaddy.com/v1/domains/$($mydomain)/records/A/$($myhostname)" -Headers @{ Authorization = "sso-key $($gdapikey)" } -ContentType "application/json" -Body "[{`"data`": `"$($myip)`"}]";
#}

$gpsapikey = "ZfawCUqW1rTyB87:vsMmJwRoiHtJW6G"
#$response = Invoke-RestMethod -Method Post -Uri "http://192.168.0.100/cargps/api/gpsapi/engine" -Headers @{ Authorization = "$($gpsapikey)" } -ContentType "application/json" -Body "{`"engine`": `"s`"}";
#$response = Invoke-RestMethod -Method Post -Uri "http://192.168.0.100/cargps/api/gpsapi/batterystatus" -Headers @{ Authorization = "$($gpsapikey)" } -ContentType "application/json" -Body "{`"battery`": `"100%`"}";
$response = Invoke-RestMethod -Method Post -Uri "http://192.168.0.100/cargps/api/gpsapi/gpsinfo" -Headers @{ Authorization = "$($gpsapikey)" } -ContentType "application/json" -Body "{`"cur_datetime`": null,`"type`":`"info`",`"latitude`":0.0,`"longitude`":0.0,`"altitude`":null,`"speed`":null,`"heading`":null,`"climb`":null,`"status`":null}";

Write-Output "response:$($response)";
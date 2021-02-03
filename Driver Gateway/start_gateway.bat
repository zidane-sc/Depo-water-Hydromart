
start pm2-mr.bat
@echo off
timeout 5
start pm2-ws.bat
timeout 3
pm2-startup install
timeout 3
pm2 save
exit

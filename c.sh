#!/bin/bash

unset  VITE_API_URL
npm run build
rm -r  /home/cmsnow/www/hosts/www.asonelist.com/docs/A000001027002002/ws/dist
rm -r  /home/cmsnow/www/hosts/www.asonelist.com/docs/A000001027002002/ws/php
cp -r dist  /home/cmsnow/www/hosts/www.asonelist.com/docs/A000001027002002/ws/dist
cp -r php  /home/cmsnow/www/hosts/www.asonelist.com/docs/A000001027002002/ws/php

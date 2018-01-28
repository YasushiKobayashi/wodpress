#!/bin/bash
url=`curl inet-ip.info`
curl -I -s "http://$url"/wordpress
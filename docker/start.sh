#!/bin/bash
# Start Supervisord to run PHP-FPM and Nginx
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf

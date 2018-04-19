#!/bin/bash
docker run -e DOCUMENTROOT='/web' -v $(dirname "$(readlink -f "$0")"):/opt/app-root/src centos/php-71-centos7 /usr/libexec/s2i/run

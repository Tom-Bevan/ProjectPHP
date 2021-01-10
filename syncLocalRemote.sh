#!/bin/sh

remote='bt911025@linserv-info-03.campus.unice.fr'
remote_dir='www/M314/PROJECT'

rsync $1 -auvz ./ $remote:$remote_dir



#!/bin/bash

if [ $# -lt 3 ]
then 
    echo "Usage: $0 <usuario> <senha> <database>"
    exit
fi

USER=$1
PASSWORD=$2
DATABASE=$3

echo 'Creating if not exists -> evento and presenca_evento'

mysql -u $USER "-p$PASSWORD" $DATABASE < scriptsBanco.sql

echo 'All done'

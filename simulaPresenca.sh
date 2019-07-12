#!/bin/bash

if [ $# -lt 1 ]
then 
    echo "Usage: $0 <nome> <email> <matricula> <qrcode>"
    exit
fi

NOME=$1
EMAIL=$2
MATRICULA=$3
QRCODE=$4

LINK=$(zbarimg $QRCODE)
LINK=$(echo $LINK | grep "QR-Code" | cut -d "'" -f 2)


echo "====="
echo "Link para registro de presença => " $LINK

curl -v -X POST $LINK --data "nome=$NOME&email=$EMAIL&matricula=$MATRICULA"

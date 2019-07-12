#!/bin/bash

if [ $# -lt 4 ]
then 
    echo "Usage: $0 <usuario> <senha> <database> <arquivo_eventos>"
    exit
fi


USER=$1
PASSWORD=$2
DATABASE=$3
EVENT_FILE=$4

#exec ./iniciaBancoDeDados.sh $1 $2 $3

mkdir -p QrCodes

for line in `cat $EVENT_FILE`; do
    new_line=$(echo $line | sed 's/\;/ /g')
    name_event=$(echo $new_line | awk '{print $1}')
    date_event=$(echo $new_line | awk '{print $2}')
    begin_event=$(echo $new_line | awk '{print $3}')
    end_event=$(echo $new_line | awk '{print $4}')
    place_event=$(echo $new_line | awk '{print $5}')

    count=$(echo $name_event $date_event $begin_event $end_event $place_event | wc -c)

    (( SEED=$count * $RANDOM ))
    RANDOM=$SEED    
    random_seed=$RANDOM
    code_event=$(echo $random_seed | md5sum | awk '{print $1}')

    echo 'Gerando QRCode do evento'
    qrencode -o "QrCodes/$code_event.png" "'http://localhost/registrar_presenca.php?e=$code_event'"
    echo "QRCode gerado => 'QrCodes/$code_event.png'" 

    echo 'Inserindo novo evento'
    mysql -u $USER "-p$PASSWORD" $3 -e "INSERT INTO eventos(code, name, date, begin_event, end_event, place) VALUES('$code_event', '$name_event', '$date_event', '$begin_event', '$end_event', '$place_event');"

    echo 'Tudo feito'

done

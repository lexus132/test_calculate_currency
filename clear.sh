#/bin/bash

docker kill $( docker ps -q )
docker rm $( docker ps -a -q )

if [ -n "$1" ] && [ "$1" == "-a" ]
then
    docker rmi $( docker images -q -f dangling=true );
    docker rmi $( docker images -q );
    docker volume rm $( docker volume ls -f dangling=true );
    docker network rm $(docker network ls | grep 'lamp_' | awk '{print $1}');
else
    docker rmi $(docker images | grep 'lamp_' | awk '{print $3}');
    docker volume rm $( docker volume ls -f dangling=true );
    docker network rm $(docker network ls | grep 'lamp_' | awk '{print $1}');
fi


echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ps ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"
docker ps
echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ps -a ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"
docker ps -a
echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ images ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"
docker images
echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ volume ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"
docker volume ls -f dangling=true
echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ network ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"
docker network ls --filter type=custom
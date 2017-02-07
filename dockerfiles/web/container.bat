sudo docker stop BsmartWeb1
echo "stop ok"
sudo docker rm BsmartWeb1
sudo docker build -t web1 .

sudo docker run -itd --name=BsmartWeb1 -v /home/user/site:/var/www/html web1



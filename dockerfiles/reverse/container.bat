sudo docker stop reverse
echo "stop ok"
sudo docker rm reverse
sudo docker build -t reverse .
sudo docker run -itd --name=reverse -p 80:80 -privileged reverse
 


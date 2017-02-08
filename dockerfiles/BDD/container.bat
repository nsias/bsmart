sudo docker stop bdd
echo "stop ok"
sudo docker rm bdd
sudo docker build -t bdd .
sudo docker run -itd --name=bdd bdd

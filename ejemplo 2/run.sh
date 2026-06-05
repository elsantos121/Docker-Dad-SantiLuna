docker build -t ejem02-img .

docker stop ejem02-cont
docker rm ejem02-cont

docker run -d -p 8081:80 --name ejem02-cont ejem02-img
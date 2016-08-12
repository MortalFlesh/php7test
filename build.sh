composer install --optimize-autoloader

docker pull php:7.0.9-cli
docker build -t php7test .

php7test
========

# Requirements

- docker `1.12.0`
- composer

# Install

By shell script 
    
    $ ./build.sh

or manually by

    $ composer install 
    $ docker pull php:7.0.9-cli
    $ docker build -t php7test .

# Before run

Change `~/docker/php7test` in `run.sh` to your current local path to this folder (`$ pwd`)

# Run

By shell script

    $ ./run.sh
    
or manually by

    $ docker run -it -v <YOUR_LOCAL_PATH>:/usr/src/php7test --rm --name php7test php7test
    

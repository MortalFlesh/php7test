php7test
========

Simple console application for showing and trying PHP 7 features

It allows you to run multiple commands via `Symfony/Console`

    Available commands:
      console      Runs console for PHP
      help         Displays help for a command
      list         Lists commands
      sort         Sorts values in coercive mode [default in PHP7]
      sort-strict  Sorts values in strict mode
      sum          Calculates sum in coercive mode [default in PHP7]
      sum-strict   Calculates sum in strict mode
    
     What command you want to run? [exit]:
     > 

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

    $ docker run -it -v <YOUR_LOCAL_PATH>:/usr/src/php7test -w /usr/src/php7test --rm --name php7test php7test

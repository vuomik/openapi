#!/bin/bash

docker run -it --rm --name poc -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.2-cli vendor/bin/openapi src -o poc.yaml && php index.php
#!/bin/bash
docker-compose -f $PWD/docker-compose.yml exec app php bin/console $@

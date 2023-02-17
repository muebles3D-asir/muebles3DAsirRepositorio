#!/bin/bash

php bin/console doctrine:schema:update --force
#mkdir -p config/jwt
#openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
#openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout

php bin/console lexik:jwt:generate-keypair --overwrite --quiet --env prod





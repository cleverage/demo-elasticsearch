#!/bin/sh

php src/symfony doctrine:build --all --and-load --no-confirmation
php src/symfony doctrine:init-data
php src/symfony search:delete-index
php src/symfony search:create-index
php src/symfony search:init-mapping
php src/symfony search:init-data

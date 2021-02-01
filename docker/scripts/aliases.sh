#!/bin/bash

if [ -n "$ZSH_VERSION" ]; then
   setopt aliases
else
   shopt -s expand_aliases	
fi

alias dpermit='chmod -R 777 *'
alias dartisan='docker exec -i 'build.pagevamp.pv' php artisan'
alias dcomposer='docker exec -i 'build.pagevamp.pv' composer'
alias dnodejs='docker-compose run nodejs'
alias dgulp='docker-compose run nodejs gulp'
alias dgulp-watch='docker-compose run -d nodejs gulp watch'
alias dsh='./docker/scripts/sh.sh'

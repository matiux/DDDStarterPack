#!/usr/bin/env bash
WORKDIR=/var/www/app
PROJECT_NAME=$(basename "$(pwd)" | tr '[:upper:]' '[:lower:]')
COMPOSE_OVERRIDE=
PHP_CONTAINER=php_ddd_starter_pack

if [[ -f "./docker/docker-compose.override.yml" ]]; then
  COMPOSE_OVERRIDE="--file ./docker/docker-compose.override.yml"
fi

DC_BASE_COMMAND="docker-compose
    --file docker/docker-compose.yml
    -p ${PROJECT_NAME}
    ${COMPOSE_OVERRIDE}"

DC_RUN="${DC_BASE_COMMAND}
    run
    --rm
    -u utente
    -v ${PWD}:/var/www/app
    -w ${WORKDIR}
    ${PHP_CONTAINER}"

if [ "$1" = "composer" ]; then shift 1; ${DC_RUN} composer "$@"
elif [[ "$1" == "php-cs-fixer-fix" ]]; then shift 1; ${DC_RUN} make coding-standard-fix "$@"
elif [[ "$1" == "php-cs-fixer-fix-staged" ]]; then shift 1; ${DC_RUN} make coding-standard-fix-staged
elif [[ "$1" == "php-cs-fixer-check-staged" ]]; then shift 1; ${DC_RUN} make coding-standard-check-staged
elif [[ "$1" == "phpunit" ]]; then shift 1; ${DC_RUN} make coverage
elif [[ "$1" == "psalm" ]]; then shift 1; ${DC_RUN} make psalm "$@"
elif [[ "$1" == "up" ]]; then shift 1; ${DC_BASE_COMMAND} up "$@"

elif [[ "$1" == "enter-root" ]]; then

  ${DC_BASE_COMMAND} \
    exec \
    -u root \
    ${PHP_CONTAINER} /bin/zsh

elif [[ "$1" == "enter" ]]; then

  ${DC_BASE_COMMAND} \
    exec \
    -u utente \
    -w ${WORKDIR} \
    ${PHP_CONTAINER} /bin/zsh

elif [[ "$1" == "down" ]]; then

  shift 1
  ${DC_BASE_COMMAND} \
    down "$@"

elif [[ "$1" == "purge" ]]; then

  ${DC_BASE_COMMAND} \
    down \
    --rmi=all \
    --volumes \
    --remove-orphans

elif [[ "$1" == "log" ]]; then

  ${DC_BASE_COMMAND} \
    logs -f

elif [[ "$1" == "build" ]] && [[ "$2" == "php" ]]; then

  shift 2

  ${DC_BASE_COMMAND} \
    build "$@" ${PHP_CONTAINER}

elif [[ $# -gt 0 ]]; then

  ${DC_BASE_COMMAND} \
    "$@"

else

  ${DC_BASE_COMMAND} \
    ps
fi

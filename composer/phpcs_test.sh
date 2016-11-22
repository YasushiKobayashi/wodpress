#!/bin/sh
./bin/phpcs --report=diff --report-file=./phpcs.dif --standard=ruleset.xml --ignore=*.js,*.css,*.scss ../wordpress/wp-content/themes/wp-themes/
# ./bin/phpcs --report=full --report-file=./phpcs.xml --standard=ruleset.xml --ignore=*.js,*.css,*.scss ../wordpress/wp-content/themes/wp-themes/

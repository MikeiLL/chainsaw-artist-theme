#!/usr/bin/env bash

rsync -avP *.php projects lib dist *.css *.js lang templates noah:public_html/wp/wp-content/themes/noahkenin


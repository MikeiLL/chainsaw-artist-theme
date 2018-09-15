#!/usr/bin/env bash

rsync -avP *.css lang lib *.png *.xml *.php dist templates noah:public_html/wp/wp-content/themes/noahkenin


#!/bin/bash
rm -r dbtng/database
rm -r dbtng/includes/pager.inc
rm -r dbtng/includes/tablesort.inc

cvs -d :pserver:anonymous:anonymous@cvs.drupal.org/cvs/drupal export -r HEAD -d dbtng/database drupal/includes/database

cvs -d :pserver:anonymous:anonymous@cvs.drupal.org/cvs/drupal export -r HEAD -d dbtng/includes drupal/includes/pager.inc
cvs -d :pserver:anonymous:anonymous@cvs.drupal.org/cvs/drupal export -r HEAD -d dbtng/includes drupal/includes/tablesort.inc

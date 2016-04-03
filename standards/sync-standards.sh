#!/bin/bash
# [Sync standards from parent repository]
# If needed then this script must be edited on parent repo
# https://github.com/mkungla/standard-colors so that all submodules will sync it.
# 
# NB! This should only be needed if you are developing/contributing to project
# otherwise you should trust that you got latest standards with src or package you have obtained.
# And will get updates as you download update your git src or download new release!

# Get this script path
SCRIPTPATH=$( cd $(dirname $0) ; pwd -P )

# Get presumable Standards path
STANDARDS_SRC_PATH="$(dirname -- "$SCRIPTPATH")/../../standards"

# Cases when this path is not walid:
#   1. You executed it from Parent repo
#   2. You only have repo which is submodule of https://github.com/mkungla/standard-colors

if [ -d "$STANDARDS_SRC_PATH" ] ; then
    echo "Found standards source, will sync now"
    rsync -avC --delete --delete-after --progress $STANDARDS_SRC_PATH/ $SCRIPTPATH
    echo "Sync completed!"
else
	echo "Can not sync since parent repo not found!"
fi

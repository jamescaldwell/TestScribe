#!/bin/bash

# Utility script to copy the script invocation command to the system clipboard.
# Specify this script as the program instead of php as the program to invoke in
# the intellij external tool configuration.

# Once the command is copied,
# paste the content into a terminal window to run the script.

cmd="php $*"

# pbcopy is only available on mac.
echo $cmd | pbcopy
echo The following command is copied to the system clipboard:
echo $cmd

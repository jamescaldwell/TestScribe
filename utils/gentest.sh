#!/bin/bash

# Script to make invoking the TestScribe tool for the tool itself easier.
# Run this script in the project root directory.

# Copy and customize this script to test your own repositories.

echo "Testing the TestScribe tool. Current working directory is $PWD"

# Preconfig some parameters.
# They can be customized.
# Pass all additional parameters to the tool at the end.

# Change the script name from test_scribe.php to test_scribe.phar if you use the
# phar version.
php bin/test_scribe.php generate-test --test-source-root=tests/Unit --source-root=src --bootstrap=tests/_fixture/bootstrapForTest.php $*

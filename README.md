[![Project Status](http://opensource.box.com/badges/active.svg)](http://opensource.box.com/badges)
[![Build Status](https://travis-ci.org/box/TestScribe.svg?branch=master)](https://travis-ci.org/box/TestScribe)

`TestScribe` is a tool that automates testing a piece of PHP code in isolation.

### Problem statement:

Testing a piece of code in isolation is useful. But the traditional method of writing unit tests to do
this kind of testing is tedious and time consuming.

### How does the tool help: 

This is a command line tool.
The tool takes information such as the target method name from command line arguments.
It will interactively ask you for the following inputs

* Name of the test
* What input values to give the method under test.  
* What value to return when mocked methods are called.

It will show the execution result and interactions with the mocked dependencies if any.
It will generate a complete, functional unit test in the right location for you.

[Here](https://github.com/box/TestScribe/wiki/Demo-Video-and-Presentation) is an example.

Repeat this process to generate additional tests which will be added to the test file.

It can generate a test in seconds instead of minutes.

It supports integration with mocking frameworks. Thus it allows you to test your code in isolation
even before your dependencies are fully implemented.

It supports integration with Intellij.
Select a method you would like to test in intellij.
Press a key to launch the tool.

The tool is initially targeted in PHP. But the technique is 
[language agnostic](https://github.com/box/TestScribe/wiki/FAQ#does-this-technique-work-for-languages-other-than-php).

# Documentation

Please see [the wiki pages](https://github.com/box/TestScribe/wiki).

## Support

Please see [the contact wiki page](https://github.com/box/TestScribe/wiki/Contact).

## Copyright and License

Copyright 2015 Box, Inc. All rights reserved.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

   http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

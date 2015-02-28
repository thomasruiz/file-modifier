# PHP File Handler

[![Author](http://img.shields.io/badge/author-Thomas%20Ruiz-blue.svg?style=flat-square)](https://twitter.com/thsruiz)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

File Handler is a library that gives you the ability to generate and modify PHP files.

# Installation

```
composer require thomasruiz/file-modifier
```

# Documentation

Open a file and start playing with it!

```php
$fileModifier = FileModifier::build();

$file = $fileModifier->open('path/to/file.php');
// $file is an instance of FileModifier/File/File
```

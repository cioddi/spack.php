# Spack

## requirements 
- PHP
- Linux/Unix Server

## description
Simple javascript concatenator/packer
Concatenates javascript files and inline javascript and writes it to one single file

## installation
Copy the spack folder to the document root of your website

## usage

Init spack at the beginning of your page

```
<?php 

include_once $_SERVER['DOCUMENT_ROOT'].'/spack/Spack.php';

$spack = new Spack();

?>
```


Add javascript files you like to load

```
<?php

// as an array of string filepaths
$spack->addFile(array(
    '/js/jquery.min.js',
    '/js/bootstrap.js'
    ));

// or a single string
$spack->addFile('/js/jquery-ui.min.js');
?>
```


Add inline javascript 

```
<script>
<?php 
$spack->scriptStart();
 ?>

alert('blub');

<?php 
$spack->scriptEnd();
?>
</script>
```


Build the script file and reference it

```
<?php 
$spack->build();

// results in something like <script src="/spack/packed/6666cd76f96956469e7be39d750cc7d9.js"></script>
?>
```

##MIT license
Copyright (c) 2013 Max Tobias Weber
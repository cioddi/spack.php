<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Spack Testpage</title>
</head>
<body>
<?php 

include_once $_SERVER['DOCUMENT_ROOT'].'/spack/Spack.php';

$spack = new Spack();

?>

<div id="inlineTest"></div>
<div id="externalTest"></div>
<script>
<?php 
// test inline js
$spack->scriptStart();
?>

document.getElementById('inlineTest').innerHTML = 'inline';

<?php 
$spack->scriptEnd();
?>
</script>

<?php 
// test external js
$spack->addFile('/spack/tests/test.js');
?>
<?php 
$spack->build();
?>
</body>
</html>
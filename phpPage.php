<!DOCTYPE html>
<html>
<body>

<!--Super basic php stuff-->
<h1>First php page</h1>
<?php
	function test()
	{
		static $x = 0;
		echo $x;
		$x++;
	}
	test();
	test();
	test();
?>

</body>
</html>

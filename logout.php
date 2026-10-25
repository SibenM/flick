<?php
session_start();
?>

<!DOCTYPE html>
<html>
<body>

<?php
session_unset();
session_destroy();

echo "You have been logged out. <a href='login.html'>Login again</a>";
?>  

</body>
</html>
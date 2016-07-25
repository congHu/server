<html>
<meta charset="utf-8">
<body>
<form name="convert" method="post">
    <input type="text" name="chinese">
    <input type="submit" name="submit">
</form>
</body>
</html>
<?php

include './pinyinConvert.php';

echo Pinyin($_POST["chinese"]);
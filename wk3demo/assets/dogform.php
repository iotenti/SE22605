<?php

?>
<form method="post" action="#">
    Name: <input type="text" name="name" value="<?php echo $dog['name']; ?>" /><br />
    Male: <input type="radio" name="gender" value="M" /><br />
    Female: <input type="radio" name="gender" value="F" /><br />
   Fixed: <input type="checkbox" name="fixed" value="true" /><br />
    <input type="submit" id="foo" name="action" value="<?php echo $button; ?>" />
</form>

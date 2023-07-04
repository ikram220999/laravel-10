<?php
?>

<html>
    <body>
        <form method="post", action="/addFile" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" name="file">

            <button type="submit">send</button>
        </form>

    </body>
</html>


?>
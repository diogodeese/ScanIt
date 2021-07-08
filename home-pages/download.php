<div onload="download()"></div>

<a id="download" href='<?php echo $_GET['path'] ?>' download></a>
<a id="anchor" href='../index'></a>

<script>

    (function download() {
        document.getElementById('download').click();
        document.getElementById('anchor').click();
    })()

</script>
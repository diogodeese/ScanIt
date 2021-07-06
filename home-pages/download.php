<div onload="download()"></div>

<a id="a" href='<?php echo $_GET['path'] ?>' download></a>
<a id="ab" href='../index'></a>

<script>

    (function download() {
        document.getElementById('a').click();
        document.getElementById('ab').click();
    })()

</script>

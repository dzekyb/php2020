<div id="wrapper">
    <div id="bg"></div>
    <div id="overlay"></div>
    <div id="main">
        <?php require 'includes/main.php'; ?>
    </div>
</div>
<script>
    window.onload = function() { document.body.classList.remove('is-preload'); }
    window.ontouchmove = function() { return false; }
    window.onorientationchange = function() { document.body.scrollTop = 0; }
</script>
<?php
function compress($buffer) {
    //$buffer = str_replace("\n", "", str_replace("  ", '', $buffer));
    $buffer = str_replace("  ", '', $buffer);
    return $buffer;
}
ob_start('compress');
?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="short icon" type="image/gif" href="data:image/gif;base64,R0lGODlhEAAQAIAAAAAAAAAAACH5BAkAAAEALAAAAAAQABAAAAIgjI+py+0PEQiT1lkNpppnz4HfdoEH2W1nCJRfBMfyfBQAOw==" />
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>Demo</title>
<?php
//if ($_COOKIE['style_cache']) {
if (true) {
?>
<style type="text/css" media="screen">
    #demo {
        background: red;
        width: 50px;
        height: 50px;
    }
</style>
<?php
} else {
?>
<script type="text/javascript" charset="utf-8">
    document.write(localStorage.getItem(<?php echo $_COOKIE['style_cache'];?>)); //TODO: fix XSS security hole
</script>
<?php
}
?>
</head>
<body>
    <div id="demo">
    </div>

<?php
if (isset($_COOKIE['script_cache'])) {
?>
    <script type="text/javascript" charset="utf-8" id="inline-script">
        function clickHandler() {
            alert('click');
        }
        document.getElementById('demo').addEventListener('click', clickHandler, false);
    </script>

    <script type="text/javascript" charset="utf-8">
        localStorage.setItem('abc', document.getElementById("inline-script").text);
        document.cookie="script_cache=abc"; //TODO: make it permanent
    </script>
<?php
} else {
?>
    <script type="text/javascript" charset="utf-8">
        var text = localStorage.getItem("<?php echo $_COOKIE['script_cache'];?>"); //TODO: fix XSS security hole
        document.write('<scrip' + 't>' + text + '</scrip' + 't>');
    </script>
<?php
}
?>

</body>
</html>

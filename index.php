<?php
function compress($buffer) {
    //$buffer = str_replace("\n", "", str_replace("  ", '', $buffer));
    $buffer = str_replace("  ", '', $buffer);
    return $buffer;
}
ob_start('compress');

/*
$rssUrl = 'http://feeds.boston.com/boston/bigpicture/index';
$rss = simplexml_load_file($rssUrl);
var_dump($rss);
 */

$data = array(
'img' => array(
    'http://inapcache.boston.com/universal/site_graphics/blogs/bigpicture/libya_may_2011/bp1.jpg',
    'http://inapcache.boston.com/universal/site_graphics/blogs/bigpicture/libya_may_2011/bp2.jpg',
    'http://inapcache.boston.com/universal/site_graphics/blogs/bigpicture/libya_may_2011/bp3.jpg',
    'http://inapcache.boston.com/universal/site_graphics/blogs/bigpicture/libya_may_2011/bp4.jpg',
    'http://inapcache.boston.com/universal/site_graphics/blogs/bigpicture/libya_may_2011/bp5.jpg',
    'http://inapcache.boston.com/universal/site_graphics/blogs/bigpicture/libya_may_2011/bp6.jpg'
)
);

$imgWidth = 320;
$imgHeight = 200;

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
foreach($data['img'] as $imgUrl) {
    $bucket = crc32($imgUrl) % 5;
    $bucket = $bucket ? $bucket : '';
?>
<div>
<img src="<?php echo 'http://src' . $bucket . '.sencha.io/' . $imgWidth . '/' . $imgUrl?>">
</div>
<?php
}
?>



<?php
if (!isset($_COOKIE['script_cache'])) {
?>
    <script type="text/javascript" charset="utf-8" id="inline-script">
<?php include('demo.js') ?>
    </script>

    <script type="text/javascript" charset="utf-8">
        localStorage.setItem('abc', document.getElementById("inline-script").text);
        document.cookie="script_cache=abc"; //TODO: make it permanent
    </script>
<?php
} else {
?>
    <script type="text/javascript" charset="utf-8" id="inline-script">
        eval(localStorage.getItem("<?php echo $_COOKIE['script_cache'];?>")); //TODO: fix XSS security hole
    </script>
<?php
}
?>

</body>
</html>

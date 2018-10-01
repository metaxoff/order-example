<?php

$orderPath = "./order.php";

function getTextBetweenTags($string, $tagname){
    $d = new DOMDocument();
    $d->loadHTML($string);
    $return = array();
    foreach($d->getElementsByTagName($tagname) as $item){
        $return[] = $item->textContent;
    }
    return $return;
}
function renderOrder($path)
{
    ob_start();
    include($path);
    $var = ob_get_contents();
    ob_end_clean();

    return $var;
}

$content = renderOrder( $orderPath);
$orderId  = trim(getTextBetweenTags($content, "h1")[0]);
$filename = realpath('./data/order'.$orderId.'.html');
file_put_contents($filename,$content,FILE_APPEND);
echo "Order was saved as html in " . $filename;

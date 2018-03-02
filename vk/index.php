<?php
/**
 * Created by PhpStorm.
 * User: Трик
 * Date: 04.08.2016
 * Time: 22:47
 */

mb_internal_encoding("UTF-8");
require_once "lib/database_class.php";
require_once  "lib/doit_class.php";
require_once  "lib/mainpagecontent_class.php";


$db = new DataBase();
$view = $_GET["view"];
$do = $_GET["do"];
if(isset($do)) {
    $doit = new doIt($db);
    switch ($do) {
        case "in_pre_work": $doit->doInPreWork();
            break;
        case "in_work": $doit->doInWork();
            break;
        case "cancel_in_work": $doit->doCancelInWork();
            break;
        case "cancel_work": $doit->doCancelWork();
            break;
        case "cancel_delete": $doit->doCancelDelete();
            break;
        case "delete": $doit->doDelete();
            break;
        case "pre_delete": $doit->doPreDelete();
            break;
        case "fav_del": $doit->doFavDelete();
            break;
        default: break;
    }
}

switch ($view) {
    case "": $content = new ViewMainPageContent($db);
        break;
    default: exit;
}

echo $content->getContent();
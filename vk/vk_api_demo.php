<?php
/**
 * Created by PhpStorm.
 * User: Трик
 * Date: 10.12.2016
 * Time: 23:46
 */
require_once('src/Vkontakte.php');

$accessToken = '10d08dc260bd53c3dc3dfee66c416e2cf0f9a1f5656c707b81fd7b418bcf66c5365613ef3a16fcee841e4767fe620';
$vkAPI = new \BW\Vkontakte(["access_token" => $accessToken]);
$publicID = 135029270;

if ($vkAPI->postToPublic($publicID, "Привет Хабр!", 'https://hydra-media.cursecdn.com/pathofexile.gamepedia.com/a/a1/Basic_passive_frame.png?version=4e8f8559ac5954874a0c6428eaf337b2', array('вконтакте api', 'автопостинг', 'первые шаги'))) {

    echo "Ура! Всё работает, пост добавлен\n";

} else {

    echo "Фейл, пост не добавлен(( ищите ошибку\n";
}
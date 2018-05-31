<?php
/**
 * Created by PhpStorm.
 * User: 13975
 * Date: 2018/5/30
 * Time: 15:16
 */
$url = 'https://juejin.im';
$url_entry = 'https://timeline-merger-ms.juejin.im/v1/get_entry_by_rank';
$url_punch = 'https://ubc-api-ms.juejin.im/v1/punch';
$url_recommend = 'https://recommender-api-ms.juejin.im/v1/get_recommended_entry?suid=J3rzUv6EaFYYfem2QFZQ&ab=welcome_3&src=web';

$sub_location = [
    'frontend' => '5562b415e4b00c57d9b94ac8',
    'android' => '5562b410e4b00c57d9b94a92',
    'backend' => '5562b419e4b00c57d9b94ae2',
    'ai' => '57be7c18128fe1005fa902de',
    'ios' => '5562b405e4b00c57d9b94a41',
    'freebie' => '5562b422e4b00c57d9b94b53'];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书

curl_exec($ch);
print_r(curl_getinfo($ch));
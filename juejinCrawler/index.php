<?php
/**
 * Created by PhpStorm.
 * User: 13975
 * Date: 2018/5/30
 * Time: 15:16
 */
$url = 'https://juejin.im';

/**
 * method: GET
 * param:
 * src:
 * limit:
 * category: 种类
 */
$url_entry = 'https://timeline-merger-ms.juejin.im/v1/get_entry_by_rank';

/**
 * method: GET
 * param:
 * sub_location : $sub_location
 * location: welcome
 * suid: J3rzUv6EaFYYfem2QFZQ
 * src: juejin.im
 */
$url_punch = 'https://ubc-api-ms.juejin.im/v1/punch';

/**
 * method: GET
 * param:
 * suid:
 * ab: welcome_3
 * src: web
 */
$url_recommend = 'https://recommender-api-ms.juejin.im/v1/get_recommended_entry?suid=J3rzUv6EaFYYfem2QFZQ&ab=welcome_3&src=web';

$category = [
    'frontend' => '5562b415e4b00c57d9b94ac8',
    'android' => '5562b410e4b00c57d9b94a92',
    'backend' => '5562b419e4b00c57d9b94ae2',
    'ai' => '57be7c18128fe1005fa902de',
    'ios' => '5562b405e4b00c57d9b94a41',
    'freebie' => '5562b422e4b00c57d9b94b53'
];

$ch = curl_init();
$cookie = '';
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);

$url_entry .= '?src=web&limit=5&category='.$category['android'];

curl_setopt($ch, CURLOPT_URL, $url_entry);

$content = json_decode(curl_exec($ch));

//echo '<pre>';
print_r($content);

function dumpRecommendToMarkdown(string $file, object $content) {

    $fp = fopen($file, "w");

    foreach ($content->d as $item) {

        fwrite($fp, '## '.$item->title."\n");
        foreach ($item->tags as $tag) {

            fwrite($fp, '【'.$tag->title.'】');
        }
        if ($item->type === 'post') {

            $type = 'post';
        } else {

            $type = 'entry';
        }
        fwrite($fp, "\n\n作者：<img height=\"30px\" src=\"{$item->user->avatarLarge}\" alt={$item->user->username} />".$item->user->username."\n\n[点此查看](".'https://juejin.im/'.$type.'/'.$item->objectId.")\n\n\n");
    }

    fclose($fp);
}

function dumpHotArticleToMarkdown(string $file, object $content) {



    $fp = fopen($file, 'w');
    foreach ($content->d->entrylist as $article) {

        fwrite($fp, '## '.$article->title."\n\n[点此查看]".'(https://juejin.im/entry/'.$article->objectId.")\n\n");
    };

    return fclose($fp);
}

//dumpRecommendToMarkdown("./content.md", $content);
//dumpHotArticleToMarkdown('hot.md', $content);
<?php
/**
 * 掘金热点文章爬虫相关函数
 * @author 1000Delta
 */

require '../CodeLib/MyClass/Database/DBC.php';

/**
 * 发送掘金热点文章json到前端
 * @param string $kind 文章类型
 * @param int $limit 文章数目
 * @return int
 */
function sendEntryToFronted(string $kind, int $limit) {

    $category = [
        'frontend' => '5562b415e4b00c57d9b94ac8',
        'android' => '5562b410e4b00c57d9b94a92',
        'backend' => '5562b419e4b00c57d9b94ae2',
        'ai' => '57be7c18128fe1005fa902de',
        'ios' => '5562b405e4b00c57d9b94a41',
        'freebie' => '5562b422e4b00c57d9b94b53'
    ];
    $url_entry = 'https://timeline-merger-ms.juejin.im/v1/get_entry_by_rank?src=web&limit='.$limit.'&category='.$category[$kind];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 掘金采取https协议需要设置此参数才能爬取内容
    curl_setopt($ch, CURLOPT_URL, $url_entry);

    $content = json_decode(curl_exec($ch));

    $data = [];
    $i = 0;
    foreach ($content->d->entrylist as $item) {

        $data[$i]['title'] = $item->title;
        $j = 0;
        foreach ($item->tags as $tag) {

            $data[$i]['tags'][$j++] = $tag->title;
        }
        $data[$i++]['url'] = 'https://juejin.im/entry/'.$item->objectId;
    }
    echo(json_encode($data));
    return 0;

}

/**
 * 发送掘金推荐文章列表json到前端
 * @return int
 */
function sendRecommendToFronted() {

    $url_recommend = 'https://recommender-api-ms.juejin.im/v1/get_recommended_entry?suid=J3rzUv6EaFYYfem2QFZQ&ab=welcome_3&src=web';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 掘金采取https协议需要设置此参数才能爬取内容
    curl_setopt($ch, CURLOPT_URL, $url_recommend);

    $content = json_decode(curl_exec($ch));

    $data = [];
    $i = 0;
    foreach ($content->d as $item) {

        $data[$i]['title'] = $item->title;
        $j = 0;
        foreach ($item->tags as $tag) {

            $data[$i]['tags'][$j++] = $tag->title;
        }
        $data[$i++]['url'] = 'https://juejin.im/entry/'.$item->objectId;
    }
    echo(json_encode($data));
    return 0;
}

/**
 * 导出掘金推荐文章到Markdown
 * @param string $file 要保存的文件名
 * @return bool
 */
function dumpRecommendToMarkdown(string $file) {

    $url_recommend = 'https://recommender-api-ms.juejin.im/v1/get_recommended_entry?suid=J3rzUv6EaFYYfem2QFZQ&ab=welcome_3&src=web';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 掘金采取https协议需要设置此参数才能爬取内容
    curl_setopt($ch, CURLOPT_URL, $url_recommend);

    $content = json_decode(curl_exec($ch));

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
        fwrite($fp, "\n\n[点此查看](".'https://juejin.im/'.$type.'/'.$item->objectId.")\n\n\n");
    }

    return fclose($fp);
}

/**
 * 导出掘金热点文章到Markdown
 * @param string $file 要保存的文件名
 * @param string $kind 文章种类
 * @param int $limit 文章数量
 * @return bool 是否成功，fclose()返回值
 */
function dumpEntryToMarkdown(string $file, string $kind, int $limit) {

    $category = [
        'frontend' => '5562b415e4b00c57d9b94ac8',
        'android' => '5562b410e4b00c57d9b94a92',
        'backend' => '5562b419e4b00c57d9b94ae2',
        'ai' => '57be7c18128fe1005fa902de',
        'ios' => '5562b405e4b00c57d9b94a41',
        'freebie' => '5562b422e4b00c57d9b94b53'
    ];
    $url_entry = 'https://timeline-merger-ms.juejin.im/v1/get_entry_by_rank?src=web&limit='.$limit.'&category='.$category[$kind];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 掘金采取https协议需要设置此参数才能爬取内容
    curl_setopt($ch, CURLOPT_URL, $url_entry);

    $content = json_decode(curl_exec($ch));

    $fp = fopen($file, 'w');
    foreach ($content->d->entrylist as $article) {

        fwrite($fp, '## '.$article->title."\n\n[点此查看]".'(https://juejin.im/entry/'.$article->objectId.")\n\n");
    };

    return fclose($fp);
}

/**
 * 保存掘金热点Top100到数据库
 */
function saveTop100HotInDB() {

    $db = new MyClass\Database\DBC(1, '127.0.0.1','root', '1000Delta', 'juejin');
    $db->connect();
    $pre = $db->prepare('INSERT INTO hot_top100 (title, category, url, rank)VALUES (?,?,?,?)');
    $article = [
        'title' => null,
        'category' => null,
        'url' => null,
        'rank' => null
        ];
    $pre->bindParam(1, $article['title']);
    $pre->bindParam(2, $article['category']);
    $pre->bindParam(3, $article['url']);
    $pre->bindParam(4, $article['rank']);


    $category = [
        'frontend' => '5562b415e4b00c57d9b94ac8',
        'android' => '5562b410e4b00c57d9b94a92',
        'backend' => '5562b419e4b00c57d9b94ae2',
        'ai' => '57be7c18128fe1005fa902de',
        'ios' => '5562b405e4b00c57d9b94a41',
        'freebie' => '5562b422e4b00c57d9b94b53'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 掘金采取https协议需要设置此参数才能爬取内容

    foreach ($category as $kind) {

        $url_entry = 'https://timeline-merger-ms.juejin.im/v1/get_entry_by_rank?src=web&limit=100&category='.$kind;
        curl_setopt($ch, CURLOPT_URL, $url_entry);

        $content = json_decode(curl_exec($ch));

        foreach ($content->d->entrylist as $item) {

            $article['title'] = $item->title;
            $article['category'] = $item->category->title;
            $article['url'] = 'https://juejin.im/entry/'.$item->objectId;
            $article['rank'] = $item->rankIndex;

            $pre->execute();
        }
    }

    return 0;
}
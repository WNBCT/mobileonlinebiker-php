<?php


class NewsController
{

    public function getData()
    {

        // Create DOM from URL
        $html = file_get_html('http://ktm100percent.com/');
        $articles = array();
        $count = 0;


        // Find all article blocks
        foreach($html->find('div.item') as $article) {

            array_push($articles, [
                'title'     => $article->find('h2.itemtitle', 0)->plaintext,
                'link'      => $article->find('h2.itemtitle > a', 0)->href,
                'date'      => $article->find('div.itemdate time', 0)->plaintext,
                'category'  => $article->find('div.itemcat a', 0)->plaintext,
                'category_link' => $article->find('div.itemcat a', 0)->href,
                'image'     => $article->find('a > img', 0)->src
            ]);

            $count++;
        }


        $arr = [
            'credit'    => 'KTM100PERCENT.COM',
            'link'      => 'http://ktm100percent.com/',
            'count'     => $count,
            'feed'      => $articles
        ];


        echo json_encode($arr);
    }

}
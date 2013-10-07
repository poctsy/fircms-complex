<?php

/**
 * @author   poctsy  <pocmail@foxmail.com>
 * @copyright Copyright (c) 2013 poctsy
 * @link      http://www.fircms.com
 * @version   ArticleCatalog.php  17:17 2013年09月13日
 */


class ArticleCatalog extends Catalog {

    /**
     * @return array customized attribute labels (name=>label)
     */
 
     public function attributeLabels() {
        return array(
            'id' => 'ID',
            'parent' => '栏目分类',
            'title' => '网页标题',
            'name' => '栏目名称',
            'thumb'=>'缩略图',
            'keyword' => '网页关键字(SEO)',
            'description' => '网页描述(SEO)',
            'type' => '栏目模式',
            'url' => '栏目网址',
            'list_view' => '文章栏目模板',
            'content_view' => '文章内容页模板',
        );
    }
 
    
}
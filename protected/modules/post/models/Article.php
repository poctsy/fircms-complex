<?php

/**
 * @version   Article.php  17:53 2013年09月11日
 * @author    poctsy <poctsy@foxmail.com>
 * @copyright Copyright (c) 2013 poctsy
 * @link      http://www.fircms.com
 */



class Article extends Post {

    public function rules() {
        return array_merge(
            array(
                array('content','required')),
            parent::rules()
        );
    }

}

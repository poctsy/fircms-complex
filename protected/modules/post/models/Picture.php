<?php
/**
 * @version   Picture.php  0:00 2013年09月18日
 * @author    poctsy <poctsy@foxmail.com>
 * @copyright Copyright (c) 2013 poctsy
 * @link      http://www.fircms.com
 */



class Picture extends Post {



    public function rules() {
        return array_merge(
            array(
                array('picture,title,catalog_id','required')),
            parent::rules()
        );
    }


}

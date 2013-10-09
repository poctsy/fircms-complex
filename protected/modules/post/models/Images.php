<?php
/**
 * @version   Images.php  10:19 2013年09月11日
 * @author    poctsy <poctsy@foxmail.com>
 * @copyright Copyright (c) 2013 poctsy
 * @link      http://www.fircms.com
 */



class Images extends Post {


    public function rules() {
        return array_merge(
            array(
                array('images','required'),),
            parent::rules()
        );
    }

}

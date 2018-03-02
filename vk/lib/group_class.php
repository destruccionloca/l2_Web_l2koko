<?php
/**
 * Created by PhpStorm.
 * User: Трик
 * Date: 11.12.2016
 * Time: 23:48
 */

class Group extends GlobalClass
{
    public function __construct($db)
    {
        parent::__construct("group", $db);
    }
}
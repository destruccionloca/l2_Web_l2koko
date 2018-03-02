<?php
/**
 * Created by PhpStorm.
 * User: Трик
 * Date: 17.10.2016
 * Time: 17:45
 */
require_once "modules_class.php";

class ViewMainPageContent extends Modules {
    


    public function __construct($db)
    {
        parent::__construct($db);

    }

    protected function getTitle()
    {
        
    }

    protected function getDescription()
    {
        // TODO: Implement getDescription() method.
    }

    protected function getKeywords()
    {
        // TODO: Implement getKeywords() method.
    }

    protected function getTop() {    

    }        

    protected function getMenu()
    {
        // TODO: Implement getMenu() method.
    }

    protected function getMiddle()
    {
        $sr["faq"] = "";
        return $this->getReplaceTemplate($sr, "vk_api");
    }

    protected function getBottom()
    {
        // TODO: Implement getBottom() method.
    }

    protected function getNavMenu()
    {
        // TODO: Implement getNavMenu() method.
    }
}
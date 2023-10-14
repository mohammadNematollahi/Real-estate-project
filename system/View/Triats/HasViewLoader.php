<?php

namespace System\View\Triats;

use Exception;
use System\Config\Config;
trait HasViewLoader
{
    protected $viewNameArray = [];

    public function viewLoader($dir)
    {
        //app.welcome;
        $dir = trim($dir, " .");
        $dir = str_replace(".", "/", $dir);
        $filePath = Config::get("app.BDIR") . "/resource/view/" . $dir . ".blade.php";
        if (!file_exists($filePath)) {
            throw new Exception("Oops somthing wrong we can not find this file path " . $filePath);
        } else {
            $this->registerView($dir);
            $content =  htmlentities(file_get_contents($filePath));
            return $content;
        }
    }
    public function registerView($dir)
    {
        array_push($this->viewNameArray, $dir);
    }
}

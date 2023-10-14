<?php

namespace System\View\Triats;

trait HasExtendsContent
{
    private $extendsContent;
    private function checkExtendsContent()
    {
        $fileNames = $this->findExtends();
        if ($fileNames) {
            $this->extendsContent = $this->viewLoader($fileNames);
            $yieldsNameArray = $this->findYields();
            if ($yieldsNameArray) {
                foreach ($yieldsNameArray as $yieldName) {
                    $this->initialYields($yieldName);
                }
            }
            $this->content = $this->extendsContent;
        }
    }

    private function findExtends()
    {
        $filePathArray = [];
        preg_match("/n*@extends\('([A-z.]*)'\)/", $this->content, $filePathArray);
        return isset($filePathArray[1]) ? $filePathArray[1] : false;
    }

    private function findYields()
    {
        $yieldsNameArray = [];
        preg_match_all("/@yield\('([a-z.\-)]*)'\)/", $this->extendsContent, $yieldsNameArray, PREG_UNMATCHED_AS_NULL);
        return isset($yieldsNameArray[1]) ? $yieldsNameArray[1] : false;
    }

    private function initialYields($yield)
    {
        $string = $this->content;
        $sectionStart = "@section('" . $yield . "')";
        $sectionEnd = "@endsection";
        $startPos = strpos($string, $sectionStart);
        if ($startPos === false) {
            return $this->extendsContent = str_replace("@yield('" . $yield . "')", "", $this->extendsContent);
        }
        $startPos += strlen($sectionStart);
        $endPos = strpos($string, $sectionEnd, $startPos);
        if ($endPos === false) {
            return $this->extendsContent = str_replace("@yield('" . $yield . "')", "", $this->extendsContent);
        }
        $getLengthParagraph = $endPos - $startPos;
        $getContent = substr($string, $startPos, $getLengthParagraph);
        return $this->extendsContent = str_replace("@yield('" . $yield . "')", $getContent, $this->extendsContent);
    }
}

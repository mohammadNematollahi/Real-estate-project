<?php

namespace System\View\Triats;

trait HasIncludeContent
{

    private function checkIncludesContent()
    {
        while (1) {
            $filesIncludeArray = $this->findIncludes();
            if ($filesIncludeArray) {
                foreach ($filesIncludeArray as $include) {
                    $this->initialIncludes($include);
                }
            } else {
                break;
            }
        }
    }
    
    private function findIncludes()
    {
        $includesNameArray = [];
        preg_match_all("/@include\('([A-z.-]*)'\)/", $this->content, $includesNameArray, PREG_UNMATCHED_AS_NULL);
        return isset($includesNameArray[1]) ? $includesNameArray[1] : false;
    }

    private function initialIncludes($include)
    {
        return $this->content = str_replace("@include('" . $include . "')", $this->viewLoader($include), $this->content);
    }
}

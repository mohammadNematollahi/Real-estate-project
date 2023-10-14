<?php

namespace System\View\Triats;

use System\Session\Session;

trait HasEchoContent
{

    private function checkEchoStatement()
    {
        $this->checkTagsEchoOpened();
        $this->checkTagsEchoClosed();
    }
    //open
    private function checkTagsEchoOpened()
    {
        $findTagsOpened = $this->findTagsOpened();
        if ($findTagsOpened) {
            foreach ($findTagsOpened as $tag) {
                $this->initialTagOpened($tag);
            }
        }
    }
    //close
    private function checkTagsEchoClosed()
    {
        $findTagsOpened = $this->findTagsClosed();
        if ($findTagsOpened) {
            foreach ($findTagsOpened as $tag) {
                $this->initialTagClosed($tag);
            }
        }
    }
    private function findTagsOpened()
    {
        $tagsOpenedArray = [];
        preg_match_all("/{{/", $this->content, $tagsOpenedArray, PREG_UNMATCHED_AS_NULL);
        return isset($tagsOpenedArray[0]) ? $tagsOpenedArray[0] : false;
    }

    private function initialTagOpened($tag)
    {

        $tagOpened = "<?php echo ";
        return $this->content = str_replace($tag, $tagOpened, $this->content);
    }


    private function findTagsClosed()
    {
        $tagsCloseddArray = [];
        preg_match_all("/}}/", $this->content, $tagsCloseddArray, PREG_UNMATCHED_AS_NULL);
        return isset($tagsCloseddArray[0]) ? $tagsCloseddArray[0] : false;
    }

    private function initialTagClosed($tag)
    {

        $tagClosed = " ?>";
        return $this->content = str_replace($tag, $tagClosed, $this->content);
    }
}

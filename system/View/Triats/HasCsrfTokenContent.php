<?php

namespace System\View\Triats;

use System\Session\Session;

trait HasCsrfTokenContent
{
    private function checkCsrfTokenContent()
    {
        $findCsrfTokens = $this->findCsrfTokens();
        if ($findCsrfTokens) {
            foreach ($findCsrfTokens as $csrf) {
                $this->initialCsrfToken($csrf);
            }
        }
    }

    private function findCsrfTokens()
    {
        $CsrfTokensArray = [];
        preg_match_all("/(@csrf)/", $this->content, $CsrfTokensArray, PREG_UNMATCHED_AS_NULL);
        return isset($CsrfTokensArray[1]) ? $CsrfTokensArray[1] : false;
    }

    private function initialCsrfToken($Csrf)
    {

        $inputCsrf = "<input type='hidden' name='csrf' value='<?= setCsrfToken() ?>'>";
        return $this->content = str_replace($Csrf, $inputCsrf, $this->content);
    }
}

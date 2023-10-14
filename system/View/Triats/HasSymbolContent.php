<?php

namespace System\View\Triats;

use System\Session\Session;

trait HasSymbolContent
{
    //rules If
    private function checkIfCondition()
    {
        $ConditionOpened = $this->findIfOpeneds();
        if ($ConditionOpened) {
            foreach ($ConditionOpened as $key => $value) {
                $this->initialIfOpened($key, $value);
            };
        }

        $ConditionClosed = $this->findIfClosed();
        if ($ConditionClosed) {
            foreach ($ConditionClosed as $end) {
                $this->initialIfClosed($end);
            };
        }
    }
    private function checkElseContent()
    {
        $findElse = $this->findElse();
        if ($findElse) {
            foreach ($findElse as $else) {
                $this->initialElse($else);
            };
        }
    }

    private function checkElseIfContent()
    {
        $findElseIfOpened = $this->findElseIfOpeneds();
        if ($findElseIfOpened) {
            foreach ($findElseIfOpened as $key => $value) {
                $this->initialElseIfOpened($key, $value);
            };
        }
    }
    private function findElseIfOpeneds()
    {
        $elseIfOpenedArray = [];
        preg_match_all("/@elseif\(([A-z0-9$&+,:;=?@#|'_<>.^*()%! -]*)\)/", $this->content, $elseIfOpenedArray, PREG_UNMATCHED_AS_NULL);
        return isset($elseIfOpenedArray[0]) && isset($elseIfOpenedArray[1]) ? array_combine($elseIfOpenedArray[0], $elseIfOpenedArray[1]) : false;
    }
    private function findIfOpeneds()
    {
        $ifOpenedArray = [];
        preg_match_all("/@if \(([A-z0-9$&+,:;=?@#|_'<>.^*()%! -]*)\)/", $this->content, $ifOpenedArray, PREG_UNMATCHED_AS_NULL);
        return isset($ifOpenedArray[0]) && isset($ifOpenedArray[1]) ? array_combine($ifOpenedArray[0], $ifOpenedArray[1]) : false;
    }

    private function findIfClosed()
    {
        $ifClosedArray = [];
        preg_match_all("/@endif/", $this->content, $ifClosedArray, PREG_UNMATCHED_AS_NULL);
        return isset($ifClosedArray[0]) ? $ifClosedArray[0] : false;
    }

    private function findElse()
    {
        $elseArray = [];
        preg_match_all("/@else/", $this->content, $elseArray, PREG_UNMATCHED_AS_NULL);
        return isset($elseArray[0]) ? $elseArray[0] : false;
    }

    private function initialIfOpened($condition, $rules)
    {
        $conditionIfOpened = "<?php if({$rules}){ ?>";
        return $this->content = str_replace($condition, $conditionIfOpened, $this->content);
    }

    private function initialElse($input)
    {
        $tagElse = "<? }else {?>";
        return $this->content = str_replace($input, $tagElse, $this->content);
    }

    private function initialIfClosed($endIf)
    {
        $conditionIfClosed = "<? } ?>";
        return $this->content = str_replace($endIf, $conditionIfClosed, $this->content);
    }
    private function initialElseIfOpened($condition, $rules)
    {
        $ElseIfOpened = "<? }elseif({$rules}) { ?>";
        return $this->content = str_replace($condition, $ElseIfOpened, $this->content);
    }

    //rules foreach
    private function checkForeachLoopsContent()
    {
        $findForeachs = $this->findForeachsOpened();
        if ($findForeachs) {
            foreach ($findForeachs as $key => $value) {
                $this->initialForeachOpened($key, $value);
            };
        }

        $ConditionClosed = $this->findForeachsClosed();
        if ($ConditionClosed) {
            foreach ($ConditionClosed as $closed) {
                $this->initialForeachClosed($closed);
            };
        }
    }

    private function findForeachsOpened()
    {
        $foreachArray = [];
        preg_match_all("/@foreach \(([A-z0-9$&+,:;=?@#|'<>.^*()%! -]*)\)/", $this->content, $foreachArray, PREG_UNMATCHED_AS_NULL);
        return isset($foreachArray[0]) && isset($foreachArray[1]) ? array_combine($foreachArray[0], $foreachArray[1]) : false;
    }

    private function initialForeachOpened($nameLoop, $rules)
    {
        $foreachOpened = "<?php foreach({$rules}){ ?>";
        return $this->content = str_replace($nameLoop, $foreachOpened, $this->content);
    }

    private function findForeachsClosed()
    {
        $foreachClosedArray = [];
        preg_match_all("/@endforeach/", $this->content, $foreachClosedArray, PREG_UNMATCHED_AS_NULL);
        return isset($foreachClosedArray[0]) ? $foreachClosedArray[0] : false;
    }

    private function initialForeachClosed($nameLoop)
    {
        $foreachClosed = "<?php } ?>";
        return $this->content = str_replace($nameLoop, $foreachClosed, $this->content);
    }

    //rules for

    private function checkForLoopsContent()
    {
        $findForOpened = $this->findForOpened();
        if ($findForOpened) {
            foreach ($findForOpened as $key => $value) {
                $this->initialForOpened($key, $value);
            };
        }

        $findForClosed = $this->findForClosed();
        if ($findForClosed) {
            foreach ($findForClosed as $closed) {
                $this->initialForClosed($closed);
            };
        }
    }

    private function findForOpened()
    {
        $forArray = [];
        preg_match_all("/@for \(([A-z0-9$&+,:;=?@#|'<>.^*()%! -]*)\)/", $this->content, $forArray, PREG_UNMATCHED_AS_NULL);
        return isset($forArray[0]) && isset($forArray[1]) ? array_combine($forArray[0], $forArray[1]) : false;
    }
    private function findForClosed()
    {
        $endforArray = [];
        preg_match_all("/@endfor/", $this->content, $endforArray, PREG_UNMATCHED_AS_NULL);
        return isset($endforArray[0]) ? $endforArray[0] : false;
    }

    private function initialForOpened($nameLoop, $rules)
    {
        $ForOpened = "<?php for({$rules}){ ?>";
        return $this->content = str_replace($nameLoop, $ForOpened, $this->content);
    }

    private function initialForClosed($nameLoop)
    {
        $ForClosed = "<?php } ?>";
        return $this->content = str_replace($nameLoop, $ForClosed, $this->content);
    }
}

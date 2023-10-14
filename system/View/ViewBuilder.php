<?php

namespace System\View;

use System\View\Triats\HasViewLoader;
use System\View\Triats\HasExtendsContent;
use System\View\Triats\HasIncludeContent;
use System\View\Triats\HasCsrfTokenContent;
use System\View\Triats\HasEchoContent;
use System\View\Triats\HasSymbolContent;

use App\Providers\AppServiceProvider;

class ViewBuilder
{
    use HasViewLoader, HasExtendsContent, HasIncludeContent, HasCsrfTokenContent, HasEchoContent, HasSymbolContent;
    public $content;
    public $varsComposer = [];

    public function run($dir)
    {
        $this->content = $this->viewLoader($dir);
        $this->checkExtendsContent();
        $this->checkIncludesContent();
        $this->checkCsrfTokenContent();
        $this->checkEchoStatement();
        $this->checkIfCondition();
        $this->checkElseIfContent();
        $this->checkElseContent();
        $this->checkForeachLoopsContent();
        $this->checkForLoopsContent();
        Composer::setViews($this->viewNameArray);
        $this->varsComposer = Composer::getVars();
    }
}

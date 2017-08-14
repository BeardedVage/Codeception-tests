<?php
namespace Helper;
use AcceptanceTester;

class Acceptance extends \Codeception\Module
{
    private $webDriverModule = null;

    public function waitPageLoad(AcceptanceTester $I, $timeout = 10)
    {
        //wait for JS
        $I->waitForJs('return document.readyState == "complete"', $timeout);
        //wait for ajax
        $I->waitForJS('return !!window.jQuery && window.jQuery.active == 0;', $timeout);
    }
}

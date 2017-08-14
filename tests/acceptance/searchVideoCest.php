<?php
use Page\Search;
use Step\Acceptance\SearchStep;

class relatedVideoCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    public function checkThumbImageChanges(AcceptanceTester $I, SearchStep $search)
    {
        $I->wantTo('move mouse on 1st video in results of search and check that thumb image changes');
        //opening a page from acceptance config (yandex)
        $I->amOnPage('/video');

        //using stepObject for searching
        $search->searchBy('ураган');
        $search->waitForSearchFinish();

        //moving mouse on 1st video from results and check slide show
        $imageLocator = Search::imageFromResultAtLine(1);
        $I->moveMouseOver($imageLocator);
        $I->seeThumbImageChanges($imageLocator);
    }
}

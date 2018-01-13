<?php

use Step\Seo\SeoStep;

class seoChangesCest
{
    public function _before(SeoTester $I)
    {
    }

    public function _after(SeoTester $I)
    {
    }

    // tests
    public function checkSEOChanges(SeoStep $I)
    {
	$csvData = $I->grabDataFromCSV();
	$tagsFromSite = $I->grabMetaTagsFromSite($csvData);
        $I->verifySeoTagsExistsOnPages($tagsFromSite, $csvData);
    }
}

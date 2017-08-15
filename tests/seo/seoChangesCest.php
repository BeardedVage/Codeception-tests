<?php

class seoChangesCest
{
    public function _before(SeoTester $I)
    {
    }

    public function _after(SeoTester $I)
    {
    }

    // tests
    public function checkSEOChanges(SeoTester $I)
    {
        $I->wantTo('open some page and check new meta data from CSV file');
        // file should be stored in 'tests/_data/seo.csv'
        $csvData = file_get_contents('tests/_data/seo.csv');

        //converting csv to array
        $lines = explode(PHP_EOL, $csvData);
        $csvData = array();
        foreach ($lines as $line) {
            $csvData[] = str_getcsv($line);
        }

        $failures = [];

        //for each line in csv get meta tags and verify title and description
        foreach ($csvData as $metaData) {

            //Try to get meta tags from url in csv
            try {
                $tags = get_meta_tags($metaData[0]);
            } catch (Exception $e) {
                $failures[] = 'Failed to open site "' . $metaData[0] . '". ' . $e->getMessage() . "\" \r\n";
                throw new Exception(implode('', $failures));
                /*
                 * comment on line with throwing exception and uncomment next line if we want to continue verification even if host is not available
                 * continue;
                */
            }

            //try to verify titles
            if (array_key_exists('title', $tags)) {
                try {
                    $I->assertEquals($tags['title'], $metaData[1]);
                } catch (Exception $e) {
                    $failures[] = 'Site: ' . $metaData[0] . '. Meta title from site "' . $tags['title'] .
                        '" is not the same as in CSV "' . $metaData[1] . "\" \r\n";
                }
            } elseif ($metaData[1] != '') {
                $failures[] = 'Site: ' . $metaData[0] . '. Meta title on site is missing, but in CSV it is "' .
                    $metaData[1] . "\" \r\n";
            }

            //try to verify descriptions
            if (array_key_exists('description', $tags)) {
                try {
                    $I->assertEquals($tags['title'], $metaData[1]);
                } catch (Exception $e) {
                    $failures[] = 'Site: ' . $metaData[0] .
                        '. Meta title from site "' . $tags['description'] . '" is not the same as in CSV "' .
                        $metaData[1] . "\" \r\n";
                }
            } elseif ($metaData[1] != '') {
                $failures[] = 'Site: ' . $metaData[0] . '. Meta description on site is missing, but in CSV it is "' .
                    $metaData[1] . "\" \r\n";
            }
        }

        //throw exception if array with errors is not empty
        if (!empty($failures)) {
            throw new Exception(implode('', $failures));
        }
    }
}

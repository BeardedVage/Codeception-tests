<?php
namespace Step\Seo

class SeoStep extends \SeoTester
{
    private $failures = [];

    public function grabDataFromCSV($csvPath = 'tests/_data/seo.csv')
    {
        $csvData = file_get_contents($csvPath);

        //converting csv to array
        $lines = explode(PHP_EOL, $csvData);
        $csvData = array();
        foreach ($lines as $line) {
            $csvData[] = str_getcsv($line);
        }
	return $csvData;
    }

    public function grabMetaTagsFromSite($csvData)
    {
        try {
            $tags = get_meta_tags($csvData[0]);
        } catch (Exception $e) {
            $this->failures = 'Failed to open site "' . $csvData[0] . '". ' . $e->getMessage() . "\" \r\n";
            continue;
        }
	return $tags;
    }

    public function verifySeoTagsExistsOnPages($tagsFromSite, $seoDataFromCSV)
    {
	foreach ($csvData as $metaData) {
            //try to verify titles
            try {
                $I->assertEquals($tagsFromSite['title'], $metaData[1]);
            } catch (Exception $e) {
                array_push($this->failures, 'Site: ' . $metaData[0] . '. Meta title from site "' . $tagsFromSite['title'] .
                    '" is not the same as in CSV "' . $metaData[1] . "\" \r\n");
            }

            //try to verify descriptions
            try {
                $I->assertEquals($tagsFromSite['description'], $metaData[2]);
            } catch (Exception $e) {
                array_push($this->failures, 'Site: ' . $metaData[0] . '. Meta description from site "' . $tagsFromSite['description'] .
                    '" is not the same as in CSV "' . $metaData[2] . "\" \r\n");
            }
        }

        //throw exception if array with errors is not empty
        if (!empty($this->failures)) {
            throw new Exception(implode('', $this->failures));
        }
    }
}
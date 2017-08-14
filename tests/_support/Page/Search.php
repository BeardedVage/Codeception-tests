<?php
namespace Page;

class Search
{
    //search field
    public static $searchField = 'input[type="search"]';
    //search button
    public static $searchButton = '.search2__button button';

    //preloader
    public static $preloader = '.fade_progress_yes .spin2';

    public static function imageFromResultAtLine($resultNumber)
    {
        return '.serp-item_type_search:nth-child(' . $resultNumber . ') img.thumb-image__image.thumb-preview__target';
    }
}

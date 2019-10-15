<?php

namespace Sunnysideup\ReportsPagesWithVideos;

use SilverStripe\CMS\Model\RedirectorPage;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\CMS\Model\VirtualPage;
use SilverStripe\Core\ClassInfo;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Reports\Report;
use SilverStripe\ORM\DB;
use SilverStripe\Versioned\Versioned;

class ReportsPagesWithVideosBaseClass extends Report
{

    protected $types = [
        'iframe' => 'contains an iframe',
        'youtube.com' => 'youtube.com',
        'vimeo.com' => 'vimeo.com',
    ];

    public function title()
    {
        return "Pages with videos";
    }

    public function group()
    {
        return 'Embed Content';
    }

    public function sourceRecords($params = null)
    {
        // Get class names for page types that are not virtual pages or redirector pages
        $classes = array_diff(
            ClassInfo::subclassesFor(SiteTree::class),
            ClassInfo::subclassesFor(VirtualPage::class),
            ClassInfo::subclassesFor(RedirectorPage::class)
        );
        $idList = [];
        $type = array_key_first($this->types);
        if($params && isset($params['VideoType'])) {
            if(isset($this->types[$params['VideoType']])) {
                $type = $params['VideoType'];
            }
        } else {
        }
        foreach($classes as $className) {
            $fields = Config::inst()->get($className, 'db');
            foreach($fields as $fieldName => $fieldType) {
                if($fieldType === 'HTMLText') {
                    $filter = [$fieldName.':PartialMatch' => $type];
                    $pages = $className::get()->filter($filter);
                    if($pages->count()) {
                        $pages = $pages->column('ID');
                        $idList += $pages;
                    }
                }
            }
        }

        return SiteTree::get()->filter(['ID' => $idList]);
    }

    public function columns()
    {
        return array(
            "Title" => array(
                "title" => "Title",
                "link" => true,
            ),
        );
    }

    public function parameterFields()
    {
        return new FieldList(
            new DropdownField(
                'VideoType',
                'Source',
                $this->types
            )
        );
    }
}

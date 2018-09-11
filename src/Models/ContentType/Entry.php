<?php
/*
 * Dependency loading
 * */

namespace Contentstack\Models\ContentType;

use Contentstack\Support\Utility;
use Contentstack\Models\ContentType\BaseQuery;

class Entry extends BaseQuery {
    var $operation;
    var $_query;
    var $entryUid;
    var $contentType = array();

    /*
     * Entry
     * Entry Class to initalize your Entry
     * @param
     *      entry_uid: Entry to be fetched.
     * */
    public function __construct($entryUid = '', $contentType = '') {
        $this->entryUid = $entryUid;
        parent::__construct($contentType, $this);
        if(!\Contentstack\Utility\isEmpty($entryUid))
            return $this;
    }

    /*
     * fetch
     * Fetch the specified entry
     * */
    public function fetch() {
        $this->operation = __FUNCTION__;
        return \Contentstack\Utility\contentstackRequest($this);
    }
}

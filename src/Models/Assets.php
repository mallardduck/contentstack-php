<?php
/*
 * Dependency loading
 * */
namespace Contentstack\Models;

use Contentstack\Support\Utility;
use Contentstack\Models\ContentType\Query;
use Contentstack\Models\ContentType\BaseQuery;

/*
 * Class Assets
 * */
class Assets extends BaseQuery {

    var $operation;
    var $assetUid = '';
    var $stack = '';
    var $type = '';


    /*
     *
     * Assets constructor
     * @param
     *        string|assetUid - valid asset uid relevent to configured stack
     *        stack - valid stack configured details
     * */
    public function __construct($asset_uid = '', $stack = '') {

         if($asset_uid == ''){
            $this->stack = $stack;
            $this->type = 'assets';
        }else{
            $stack->type = 'asset';
            $this->assetUid = $asset_uid;
            parent::__construct($stack, $this);
         }
    }

    /*
     * Query
     * Query object to create the "Query" on the specified ContentType
     * @returns Query
     * */
    public function Query() {
        return new Query($this, $this->type);
    }


     /*
     * fetch
     * Fetch the specified assets
     * */
    public function fetch() {
        $this->operation = __FUNCTION__;
       return \Contentstack\Utility\contentstackRequest($this, 'asset');
    }


}

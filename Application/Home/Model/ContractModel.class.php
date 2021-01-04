<?php
namespace Home\Model;
use Think\Model;
use Think\Model\RelationModel;
class contractModel extends RelationModel{
    protected $_link = array(
    'paylist' => array(
    'mapping_type'  => self::HAS_MANY,
    'class_name'    => 'paylist',
    'mapping_key' =>'contract_id',
    'foreign_key'   => 'contract_id',
    'mapping_fields'=>'vote_time,pay_amount,id,pay_time,ratio',
//	 'mapping_limit'=>'6',
), 
     'item' => array(
    'mapping_type'  => self::HAS_ONE,
    'class_name'    => 'item',
    'mapping_key' =>'item_id',
    'foreign_key'   => 'item_id',
    'mapping_fields'=>'item_supervisor,item_name,su_company',
//   'mapping_limit'=>'6',
),
	
    );
	  public function addcondition($v){
    $this->_link['paylist']['condition']=$v;
    return $this->_link;
  }
	
	
}


?>
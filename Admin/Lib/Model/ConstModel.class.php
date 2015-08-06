<?php 
class ConstModel extends Model 
{
	protected $_validate     =     array( 
        array('name','require','名称必须！',1), 
        ); 
   /* // 自动填充设置 
    protected $_auto     =     array( 
        array('postdate',time,1,'function'), 
		array('editdate',time,2,'function'),
        ); */

}
?>
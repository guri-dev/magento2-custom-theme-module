<?php
namespace Pilot\Smile\Model\ResourceModel\Banner;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'banner_id';
	protected $_eventPrefix = 'pilot_smile_banner_collection';
	protected $_eventObject = 'banner_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Pilot\Smile\Model\Banner', 'Pilot\Smile\Model\ResourceModel\Banner');
	}

}

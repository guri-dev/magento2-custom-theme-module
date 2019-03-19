<?php
namespace Pilot\Smile\Model\ResourceModel\Options;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'option_id';
	protected $_eventPrefix = 'pilot_smile_options_collection';
	protected $_eventObject = 'options_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Pilot\Smile\Model\Options', 'Pilot\Smile\Model\ResourceModel\Options');
	}

}

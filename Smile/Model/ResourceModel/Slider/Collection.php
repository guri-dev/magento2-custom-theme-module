<?php
namespace Pilot\Smile\Model\ResourceModel\Slider;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'slide_id';
	protected $_eventPrefix = 'pilot_smile_slider_collection';
	protected $_eventObject = 'slider_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Pilot\Smile\Model\Slider', 'Pilot\Smile\Model\ResourceModel\Slider');
	}

}

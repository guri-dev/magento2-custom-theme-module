<?php
namespace Pilot\Smile\Model;
class Options extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'pilot_smile_options';

	protected $_cacheTag = 'pilot_smile_options';

	protected $_eventPrefix = 'pilot_smile_options';

	protected function _construct()
	{
		$this->_init('Pilot\Smile\Model\ResourceModel\Options');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}

<?php
namespace Pilot\Smile\Setup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
class InstallData implements InstallDataInterface
{
	protected $_optionsFactory;
	public function __construct(\Pilot\Smile\Model\OptionsFactory $optionsFactory)
	{
		$this->_optionsFactory = $optionsFactory;
	}
	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		
		$data = [
			'option_name' => "phone",
			'option_value' => "981429812",
			'status'       => 1
		];
		$smile = $this->_optionsFactory->create();
		$smile->addData($data)->save();
	}
}

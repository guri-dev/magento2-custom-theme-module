<?php
namespace Pilot\Smile\Setup;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
class UpgradeData implements UpgradeDataInterface
{
	protected $_optionsFactory;
	public function __construct(
		\Pilot\Smile\Model\OptionsFactory $optionsFactory,
		\Pilot\Smile\Model\SliderFactory $sliderFactory
		)
	{
		$this->_optionsFactory = $optionsFactory;
		$this->_sliderFactory = $sliderFactory;
	}
	public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		if (version_compare($context->getVersion(), '1.2.0', '<')) {
			$data = [
				'option_name' => "phone",
				'option_value' => "981429812",
				'status'       => 1
			];
			$smile = $this->_optionsFactory->create();
			$smile->addData($data)->save();

			// slide table
			$data = [
				'slide_title' => "This is title",
				'slide_description' => "This is slide description"
			];
			$smile = $this->_sliderFactory->create();
			$smile->addData($data)->save();
		}
	}
}

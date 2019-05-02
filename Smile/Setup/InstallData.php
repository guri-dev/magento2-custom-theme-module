<?php
namespace Pilot\Smile\Setup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
class InstallData implements InstallDataInterface
{
	protected $_optionsFactory;
	protected $_sliderFactory;
	public function __construct(
		\Pilot\Smile\Model\OptionsFactory $optionsFactory,
		\Pilot\Smile\Model\SliderFactory $sliderFactory
		)
	{
		$this->_optionsFactory = $optionsFactory;
		$this->_sliderFactory = $sliderFactory;
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

		// slider table
		$slideData = [
			'slide_title' => "This is first slide",
			'slide_description' => "This is slide description",
			'slide_link'       => 'http://google.com'
		];
		$slide = $this->_sliderFactory->create();
		$slide->addData($slideData)->save();
	}
}

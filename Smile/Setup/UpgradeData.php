<?php
namespace Pilot\Smile\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
class UpgradeData implements UpgradeDataInterface
{
	protected $_optionsFactory;
	private $eavSetupFactory;
	public function __construct(
		\Pilot\Smile\Model\OptionsFactory $optionsFactory,
		\Pilot\Smile\Model\SliderFactory $sliderFactory,
		EavSetupFactory $eavSetupFactory
		)
	{
		$this->_optionsFactory = $optionsFactory;
		$this->_sliderFactory = $sliderFactory;
		$this->eavSetupFactory = $eavSetupFactory;
	}
	public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		
		$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
		$eavSetup->addAttribute(
			\Magento\Catalog\Model\Product::ENTITY,
			'is_featured',
				[
				'group' => 'General',
				'type' => 'int',
				'backend' => '',
				'frontend' => '',
				'label' => 'Featured Product',
				'input' => 'boolean',
				'class' => '',
				'source' => '',
				'global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,
				'visible' => true,
				'required' => false,
				'user_defined' => true,
				'default' => '',
				'searchable' => false,
				'filterable' => false,
				'comparable' => false,
				'visible_on_front' => false,
				'used_in_product_listing' => true,
				'unique' => false,
				'apply_to' => 'simple,configurable,virtual,bundle,downloadable'
				] );
		
		
		
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

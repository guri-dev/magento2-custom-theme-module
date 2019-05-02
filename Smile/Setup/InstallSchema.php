<?php
namespace Pilot\Smile\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

	public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
	{
		
		$installer = $setup;
		$installer->startSetup();
		if (!$installer->tableExists('pilot_smile_options')) {
			$table = $installer->getConnection()->newTable(
				$installer->getTable('pilot_smile_options')
			)
				->addColumn(
					'option_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					null,
					[
						'identity' => true,
						'nullable' => false,
						'primary'  => true,
						'unsigned' => true,
					],
					'Option ID'
				)
				->addColumn(
					'option_name',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					['nullable => false'],
					'Option Name'
				)
				->addColumn(
					'option_value',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Option Value'
				)
				->addColumn(
					'status',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					1,
					[],
					'Option Status'
				)
				->setComment('Option table');
			$installer->getConnection()->createTable($table);

			$installer->getConnection()->addIndex(
				$installer->getTable('pilot_smile_options'),
				$setup->getIdxName(
					$installer->getTable('pilot_smile_options'),
					['option_name','option_value'],
					\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
				),
				['option_name','option_value'],
				\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
			);
		}

		// slider table
		if (!$installer->tableExists('pilot_smile_slider')) {
			$table = $installer->getConnection()->newTable(
				$installer->getTable('pilot_smile_slider')
			)
				->addColumn(
					'slide_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					null,
					[
						'identity' => true,
						'nullable' => false,
						'primary'  => true,
						'unsigned' => true,
					],
					'Slide ID'
				)
				->addColumn(
					'slide_title',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					['nullable => false'],
					'Slide Title'
				)
				->addColumn(
					'slide_description',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Slide Description'
				)
				->addColumn(
					'status',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					255,
					[],
					'Option Status'
				)
				->addColumn(
					'slide_image',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Slide Image'
				)
				->setComment('Slide table');
			$installer->getConnection()->createTable($table);

			$installer->getConnection()->addIndex(
				$installer->getTable('pilot_smile_slider'),
				$setup->getIdxName(
					$installer->getTable('pilot_smile_slide'),
					['slide_title','slide_description'],
					\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
				),
				['slide_title','slide_description'],
				\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
			);
		}

		// update slider_image column in slider table
		$installer->getConnection()->changeColumn(
			$installer->getTable('pilot_smile_slider'),
				'slide_image',
				'slide_image',
				[
					'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					'length' => 255
				]
		);

		$installer->endSetup();
	}
}

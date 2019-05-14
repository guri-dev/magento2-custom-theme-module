<?php
namespace Pilot\Smile\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

	public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
	{
		
		$installer = $setup;
		$installer->startSetup();

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

		// home page banner table
		if (!$installer->tableExists('pilot_smile_banner')) {
			$table = $installer->getConnection()->newTable(
				$installer->getTable('pilot_smile_banner')
			)
				->addColumn(
					'banner_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					null,
					[
						'identity' => true,
						'nullable' => false,
						'primary'  => true,
						'unsigned' => true,
					],
					'Banner ID'
				)
				->addColumn(
					'banner_title',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					['nullable => false'],
					'Banner Title'
				)
				->addColumn(
					'banner_description',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Banner Description'
				)
				->addColumn(
					'status',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					255,
					[],
					'Option Status'
				)
				->addColumn(
					'banner_image',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Banner Image'
				)
				->setComment('Banner table');
			$installer->getConnection()->createTable($table);

			$installer->getConnection()->addIndex(
				$installer->getTable('pilot_smile_banner'),
				$setup->getIdxName(
					$installer->getTable('pilot_smile_banner'),
					['banner_title','banner_description'],
					\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
				),
				['banner_title','banner_description'],
				\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
			);
		}

		
		// theme option
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
					'header_phone',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					['nullable => false'],
					'Header phone'
				)
				->addColumn(
					'header_email',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					['nullable => false'],
					'Header email'
				)
				->addColumn(
					'footer_about_us',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					['nullable => false'],
					'Footer About Us'
				)
				->addColumn(
					'footer_facebook',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Footer facebook URL'
				)
				->addColumn(
					'footer_rss',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Footer RSS'
				)
				->addColumn(
					'footer_email',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Footer Email'
				)
				->addColumn(
					'footer_pinterest',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Footer Pinterest'
				)
				->addColumn(
					'footer_isntagram',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Footer Instagram'
				)
				->addColumn(
					'footer_twitter_handle',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Footer Twitter handle'
				)
				->setComment('Theme options');
			$installer->getConnection()->createTable($table);

			$installer->getConnection()->addIndex(
				$installer->getTable('pilot_smile_options'),
				$setup->getIdxName(
					$installer->getTable('pilot_smile_options'),
					['footer_about_us','footer_facebook'],
					\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
				),
				['footer_about_us','footer_facebook'],
				\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
			);
		}

		$installer->endSetup();
	}
}

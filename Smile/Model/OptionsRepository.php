<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Pilot\Smile\Model;

use Pilot\Smile\Api\OptionsRepositoryInterface;
use Pilot\Smile\Api\Data;
use Pilot\Smile\Model\ResourceModel\Options as ResourceOptions;
use Pilot\Smile\Model\ResourceModel\Options\CollectionFactory as OptionsCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class BlockRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class OptionsRepository implements OptionsRepositoryInterface
{
    /**
     * @var ResourceBlock
     */
    protected $resource;

    /**
     * @var BlockFactory
     */
    protected $optionsFactory;

    /**
     * @var BlockCollectionFactory
     */
    protected $optionsCollectionFactory;

    /**
     * @var Data\BlockSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var \Magento\Cms\Api\Data\BlockInterfaceFactory
     */
    protected $dataBlockFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param ResourceSlider $resource
     * @param BlockFactory $blockFactory
     * @param Data\BlockInterfaceFactory $dataBlockFactory
     * @param BlockCollectionFactory $blockCollectionFactory
     * @param Data\BlockSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceOptions $resource,
        OptionsFactory $optionFactory,
        \Pilot\Smile\Api\Data\OptionsInterfaceFactory $dataOptionsFactory,
        OptionsCollectionFactory $optionCollectionFactory,
        //Data\SliderSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor = null
    ) {
        $this->resource = $resource;
        $this->optionsFactory = $optionsFactory;
        $this->optionsCollectionFactory = $optionsCollectionFactory;
        //$this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataOptionsFactory = $dataOptionsFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
    }

    /**
     * Save Block data
     *
     * @param \Magento\Cms\Api\Data\BlockInterface $block
     * @return Block
     * @throws CouldNotSaveException
     */
    public function save(Data\OptionsInterface $options)
    {
        if (empty($options->getOptionsId())) {
            $options->setStoreId($this->storeManager->getStore()->getId());
        }

        try {
            $this->resource->save($options);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $options;
    }

    /**
     * Load Block data by given Block Identity
     *
     * @param string $blockId
     * @return Block
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($optionId)
    {
        $options = $this->optionsFactory->create();
        $this->resource->load($options, $optionsId);
        if (!$options->getId()) {
            throw new NoSuchEntityException(__('The CMS block with the "%1" ID doesn\'t exist.', $optionsId));
        }
        return $options;
    }

    /**
     * Load Block data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Magento\Cms\Api\Data\BlockSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        /** @var \Magento\Cms\Model\ResourceModel\Block\Collection $collection */
        $collection = $this->optionsCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        /** @var Data\BlockSearchResultsInterface $searchResults */
        $searchResults = '';
        //$searchResults = $this->searchResultsFactory->create();
        //$searchResults->setSearchCriteria($criteria);
        //$searchResults->setItems($collection->getItems());
        //$searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Delete Block
     *
     * @param \Magento\Cms\Api\Data\BlockInterface $block
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(Data\OptionsInterface $options)
    {
        try {
            $this->resource->delete($options);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete Block by given Block Identity
     *
     * @param string $blockId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($optionId)
    {
        return $this->delete($this->getById($optionId));
    }

    /**
     * Retrieve collection processor
     *
     * @deprecated 102.0.0
     * @return CollectionProcessorInterface
     */
    private function getCollectionProcessor()
    {
        if (!$this->collectionProcessor) {
            $this->collectionProcessor = \Magento\Framework\App\ObjectManager::getInstance()->get(
                'Magento\Cms\Model\Api\SearchCriteria\BlockCollectionProcessor'
            );
        }
        return $this->collectionProcessor;
    }
}

<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Pilot\Smile\Model;

use Pilot\Smile\Api\BannerRepositoryInterface;
use Pilot\Smile\Api\Data;
use Pilot\Smile\Model\ResourceModel\Banner as ResourceBanner;
use Pilot\Smile\Model\ResourceModel\Banner\CollectionFactory as BannerCollectionFactory;
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
class BannerRepository implements BannerRepositoryInterface
{
    /**
     * @var ResourceBlock
     */
    protected $resource;

    /**
     * @var BlockFactory
     */
    protected $bannerFactory;

    /**
     * @var BlockCollectionFactory
     */
    protected $bannerCollectionFactory;

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
        ResourceSlider $resource,
        BannerFactory $bannerFactory,
        \Pilot\Smile\Api\Data\BannerInterfaceFactory $dataBannerFactory,
        BannerCollectionFactory $bannerCollectionFactory,
        //Data\SliderSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor = null
    ) {
        $this->resource = $resource;
        $this->bannerFactory = $bannerFactory;
        $this->bannerCollectionFactory = $bannerCollectionFactory;
        //$this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataBannerFactory = $dataBannerFactory;
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
    public function save(Data\BannerInterface $banner)
    {
        if (empty($banner->getBannerId())) {
            $banner->setStoreId($this->storeManager->getStore()->getId());
        }

        try {
            $this->resource->save($banner);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $banner;
    }

    /**
     * Load Block data by given Block Identity
     *
     * @param string $blockId
     * @return Block
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($bannerId)
    {
        $banner = $this->bannerFactory->create();
        $this->resource->load($banner, $bannerId);
        if (!$banner->getId()) {
            throw new NoSuchEntityException(__('The CMS block with the "%1" ID doesn\'t exist.', $bannerId));
        }
        return $banner;
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
        $collection = $this->bannerCollectionFactory->create();

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
    public function delete(Data\BannerInterface $banner)
    {
        try {
            $this->resource->delete($banner);
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
    public function deleteById($bannerId)
    {
        return $this->delete($this->getById($bannerId));
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

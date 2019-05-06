<?php
namespace Pilot\Smile\Block;
 
use Magento\Framework\View\Element\Template;


 
class Main extends Template
{
   /**
    * @var array|\Magento\Checkout\Block\Checkout\LayoutProcessorInterface[]
    */
    
    protected $_dataSlides;
    protected $_categoryCollectionFactory;
    protected $_categoryHelper;
    
   public function __construct(
       Template\Context $context,
       array $data = [],
       \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Catalog\Helper\Category $categoryHelper,
       \Pilot\Smile\Model\SliderFactory  $slides
   ) {
       parent::__construct($context, $data);
       $this->_categoryCollectionFactory = $categoryCollectionFactory;
        $this->_categoryHelper = $categoryHelper;
       $this->_dataSlides = $slides;
   }

   public function getCategoryCollection($isActive = true, $level = false, $sortBy = false, $pageSize = false)
   {
       $collection = $this->_categoryCollectionFactory->create();
       $collection->addAttributeToSelect('*');        
       
       // select only active categories
       if ($isActive) {
           $collection->addIsActiveFilter();
       }
               
       // select categories of certain level
       if ($level) {
           $collection->addLevelFilter($level);
       }
       
       // sort categories by some value
       if ($sortBy) {
           $collection->addOrderField($sortBy);
       }
       
       // select certain number of categories
       if ($pageSize) {
           $collection->setPageSize($pageSize); 
       }    
       
       return $collection;
   }
   
   public function getStoreCategories($sorted = false, $asCollection = false, $toLoad = true)
    {
        return $this->_categoryHelper->getStoreCategories($sorted = false, $asCollection = false, $toLoad = true);
    }
 
   public function getSlides()
   {
       $slideModel = $this->_dataSlides->create();
       $slideList = $slideModel->getCollection();
       if(!empty($slideList->getData()))
       {
            return $slideList->getData();
       }
       else
       {
            return "no slide available";
       }
       
   }
}
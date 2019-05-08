<?php
namespace Pilot\Smile\Block;
 
use Magento\Framework\View\Element\Template;


 
class Banner extends Template
{
   /**
    * @var array|\Magento\Checkout\Block\Checkout\LayoutProcessorInterface[]
    */
    
    protected $bannerFactory;
    
   public function __construct(
       Template\Context $context,
       array $data = [],
       \Pilot\Smile\Model\BannerFactory  $banner
   ) {
       parent::__construct($context, $data);
       $this->bannerFactory = $banner;
   }
 
   public function getBanner()
   {
       $bannerModel = $this->bannerFactory->create();
       $bannerList = $bannerModel->getCollection();
       if(!empty($bannerList->getData()))
       {
            return $bannerList->getData();
       }
       else
       {
            return "no Banner available";
       }
       
   }
}
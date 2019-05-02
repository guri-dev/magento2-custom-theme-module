<?php
namespace Pilot\Smile\Block;
 
use Magento\Framework\View\Element\Template;


 
class Slider extends Template
{
   /**
    * @var array|\Magento\Checkout\Block\Checkout\LayoutProcessorInterface[]
    */
    
    protected $_dataSlides;
    
   public function __construct(
       Template\Context $context,
       array $data = [],
       \Pilot\Smile\Model\SliderFactory  $slides
   ) {
       parent::__construct($context, $data);
       $this->_dataSlides = $slides;
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
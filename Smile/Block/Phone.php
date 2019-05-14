<?php
namespace Pilot\Smile\Block;
 
use Magento\Framework\View\Element\Template;
use Pilot\Smile\Model\OptionsFactory;

class Phone extends Template
{
   /**
    * @var array|\Magento\Checkout\Block\Checkout\LayoutProcessorInterface[]
    */
   protected $layoutProcessors;
   protected $_dataOptions;
 
   public function __construct(
       Template\Context $context,
       array $layoutProcessors = [],
       array $data = [],
       \Pilot\Smile\Model\OptionsFactory  $options
   ) {
       parent::__construct($context, $data);
       $this->jsLayout = isset($data['jsLayout']) && is_array($data['jsLayout']) ? $data['jsLayout'] : [];
       $this->layoutProcessors = $layoutProcessors;
       $this->_dataOptions = $options;
   }
 
   public function getPhone()
   {
        $locationModel = $this->_dataOptions->create();
        $locationList = $locationModel->getCollection();
	    $data  = $locationList->getData();
		return  $data; exit;
   }
 
}
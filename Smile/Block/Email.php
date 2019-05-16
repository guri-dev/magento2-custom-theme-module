<?php
namespace Pilot\Smile\Block;
 
use Magento\Framework\View\Element\Template;
use Pilot\Smile\Model\OptionsFactory;
 
class Email extends Template
{
   /**
    * @var array|\Magento\Checkout\Block\Checkout\LayoutProcessorInterface[]
    */
   protected $layoutProcessors;
   protected $optionsFactory;
 
   public function __construct(
       Template\Context $context,
       array $layoutProcessors = [],
       array $data = [],
       \Pilot\Smile\Model\OptionsFactory  $options
   ) {
       parent::__construct($context, $data);
       $this->jsLayout = isset($data['jsLayout']) && is_array($data['jsLayout']) ? $data['jsLayout'] : [];
       $this->layoutProcessors = $layoutProcessors;
       $this->optionsFactory = $options;
   }
 
   public function getEmail()
   {
        $optionsModel = $this->optionsFactory->create();
        $optionsList = $optionsModel->getCollection();        
        $optionsList = $optionsList->getFirstItem();
        if(!empty($optionsList->getData()))
        {
                return $optionsList->getData();
        }
        else
        {
                return "no options available";
        }
   }
 
}
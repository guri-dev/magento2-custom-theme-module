<?php
namespace Pilot\Smile\Block;
 
use Magento\Framework\View\Element\Template;


 
class Welcome extends Template
{
   /**
    * @var array|\Magento\Checkout\Block\Checkout\LayoutProcessorInterface[]
    */
    
    protected $adminCategoryTree;
    
   public function __construct(
       Template\Context $context,
       array $data = [],
       \Magento\Catalog\Block\Adminhtml\Category\Tree $adminCategoryTree
   ) {
       parent::__construct($context, $data);
       $this->adminCategoryTree = $adminCategoryTree;
   }
 
   public function getWelcome()
   {
       if (empty($this->_data['welcome'])) {
           $this->_data['welcome'] = $this->_scopeConfig->getValue(
               'design/header/welcome',
               \Magento\Store\Model\ScopeInterface::SCOPE_STORE
           );
       }
       return __($this->_data['welcome']);
   }

   public function getTree()
   {
        return $this->adminCategoryTree->getTree(); 
   }
    
}
<?php

namespace Guri\StoreLocator\Block\Adminhtml\Location\Edit\Tab;
 
use Magento\Backend\Block\Template\Context;
use Magento\Customer\Controller\RegistryConstants;
use Magento\Framework\Registry;
use Magento\Ui\Component\Layout\Tabs\TabWrapper;
 
class Invoice extends TabWrapper {
 
    protected $_coreRegistry;
 
    public function __construct(
    \Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }
 
    public function getCustomerId() {
        return $this->_coreRegistry->registry(RegistryConstants::CURRENT_CUSTOMER_ID);
    }
 
    public function getTabLabel() {
        return __("Invoice");
    }
 
    public function getTabTitle() {
        return __("Invoice");
    }
 
    public function canShowTab() {
        if ($this->getCustomerId()) {
            return true;
        }
        return false;
    }
 
    public function isHidden() {
        if ($this->getCustomerId()) {
            return false;
        }
        return true;
    }
 
    public function getTabClass() {
        return 'invoice-details';
    }
 
    public function getTabUrl() {
        return $this->getUrl('invoice/index/view', ['_current' => true]);
    }
 
    public function isAjaxLoaded() {
        return true;
    }
 
} 

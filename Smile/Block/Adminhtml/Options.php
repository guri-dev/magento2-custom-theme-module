<?php

namespace Pilot\Smile\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Options extends Container
{
   /**
     * Constructor
     *
     * @return void
     */
   protected function _construct()
    {
        $this->_controller = 'adminhtml_smile';
        $this->_blockGroup = 'Pilot_Smile';
        $this->_headerText = __('Manage Theme settings');
        $this->_addButtonLabel = __('Manage theme settings');
        parent::_construct();
    }
} 

<?php

namespace Pilot\Smile\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Slider extends Container
{
   /**
     * Constructor
     *
     * @return void
     */
   protected function _construct()
    {
        $this->_controller = 'adminhtml_slider';
        $this->_blockGroup = 'Pilot_Smile';
        $this->_headerText = __('Manage Slider');
        $this->_addButtonLabel = __('Add Slide');
        parent::_construct();
    }
} 

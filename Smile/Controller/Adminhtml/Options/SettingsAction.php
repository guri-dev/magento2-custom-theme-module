<?php
namespace Pilot\Smile\Controller\Adminhtml\Smile;
use Magento\Backend\App\Action;
/**
 * Class NewAction
 * @package Mageplaza\Productslider\Controller\Adminhtml\Slider
 */
class SettingsAction extends Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}

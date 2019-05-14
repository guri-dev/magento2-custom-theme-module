<?php
namespace Pilot\Smile\Controller\Adminhtml\Options;
use Magento\Backend\App\Action;
/**
 * Class NewAction
 * @package Mageplaza\Productslider\Controller\Adminhtml\Slider
 */
class NewAction extends Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}

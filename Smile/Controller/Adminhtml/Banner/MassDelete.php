<?php
namespace Pilot\Smile\Controller\Adminhtml\Banner;

class MassDelete extends \Magento\Backend\App\Action {

    protected $_filter;

    protected $_collectionFactory;

    public function __construct(
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Pilot\Smile\Model\ResourceModel\Banner\CollectionFactory $collectionFactory,
        \Magento\Backend\App\Action\Context $context
        ) {
        $this->_filter            = $filter;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute() {
        try{ 
            
            $logCollection = $this->_filter->getCollection($this->_collectionFactory->create());
            foreach ($logCollection as $item) {
                $item->delete();
            }
            $this->messageManager->addSuccess(__('Banner Deleted Successfully.'));
        }catch(Exception $e){
            $this->messageManager->addError($e->getMessage());
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('pilot_smile/banner/index'); //Redirect Path
    }

     /**
     * is action allowed
     *
     * @return bool
     */
    protected function _isAllowed() {
        return $this->_authorization->isAllowed('Pilot_Smile::view');
    }
} 

<?php

namespace Pilot\Smile\Controller\Adminhtml\Options;

class Index extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		
        try{
			$resultPage = $this->resultPageFactory->create();
			$resultPage->getConfig()->getTitle()->prepend((__('Smile')));
            return $resultPage; 
        } catch(Exception $e)
        {
            print_r($e); exit;
        }
		
	}


}

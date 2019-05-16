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
		if(!empty($this->getRequest()->getParam('header_phone')))
		{
			die("okok");
			$model = $this->_dataOptions->create();        
			$option_id = $this->getRequest()->getParam('option_id');
			$header_phone = $this->getRequest()->getParam('header_phone');
			$header_email = $this->getRequest()->getParam('header_email');
			$footer_about_us = $this->getRequest()->getParam('footer_about_us');
			$footer_facebook = $this->getRequest()->getParam('footer_facebook');
			$footer_rss = $this->getRequest()->getParam('footer_rss');
			$footer_email = $this->getRequest()->getParam('footer_email');
			$footer_pinterest = $this->getRequest()->getParam('footer_pinterest');
			$footer_isntagram = $this->getRequest()->getParam('footer_isntagram');
			$footer_twitter_handle = $this->getRequest()->getParam('footer_twitter_handle');


			if ($option_id) {            
				$collections = $this->_dataOptions->create()->getCollection()
					->addFieldToFilter('option_id', array('eq' => $option_id));
				foreach($collections as $item)
				{
					$item->setHeaderPhone($header_phone);
					$item->setHeaderEmail($header_email);
					$item->setFooterAboutUs($footer_about_us);
					$item->setFooterFacebook($footer_facebook);
					$item->setFooterRss($footer_rss);
					$item->setFooterEmail($footer_email);
					$item->setFooterPinterest($footer_pinterest);
					$item->setFooterIsntagram($footer_isntagram);
					$item->setFooterTwitterHandle($footer_twitter_handle);
				}
				$saveData = $collections->save();
				if($saveData){
					$this->messageManager->addSuccess( __('Record updated Successfully !') );
				}
				$this->_redirect('pilot_smile/options/index');
				
			}
			else
			{
				$model->addData([
					"header_phone" => $header_phone,
					"header_email" => $header_email,                
					"footer_about_us" => $footer_about_us,                
					"footer_facebook" => $footer_facebook,                
					"footer_rss" => $footer_rss,                
					"footer_email" => $footer_email,                
					"footer_pinterest" => $footer_pinterest,                
					"footer_isntagram" => $footer_isntagram,                
					"footer_twitter_handle" => $footer_twitter_handle                
					]);
				$saveData = $model->save();
				if($saveData){
					$this->messageManager->addSuccess( __('Insert Record Successfully !') );
				}
				$this->_redirect('pilot_smile/options/index');
			}
		}
		
			
        try{
			$resultPage = $this->resultPageFactory->create();
			$resultPage->getConfig()->getTitle()->prepend((__('Options')));
            return $resultPage; 
        } catch(Exception $e)
        {
            print_r($e); 
        }
	}


}

<?php
namespace Pilot\HelloWorld\Controller\Second;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_newsFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Pilot\HelloWorld\Model\NewsFactory $newsFactory
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->_newsFactory = $newsFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
        if(isset($_POST))
        {
            print_r($_POST);
        }
        $post = $this->_newsFactory->create();
		$collection = $post->getCollection();
		foreach($collection as $item){
			echo "<pre>";
			print_r($item->getData());
			echo "</pre>";
		}
		//return $this->_pageFactory->create();
	}
	
}

<?php

namespace Pilot\Smile\Controller\Adminhtml\Settings;
use Pilot\Smile\Model\OptionsFactory;

class Save extends \Magento\Backend\App\Action
{	
    protected $_dataOptions;

	public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Pilot\Smile\Model\OptionsFactory  $options
	)
	{
        parent::__construct($context);
        $this->_dataOptions = $options;
	}

	public function execute()
	{
		
        $model = $this->_dataOptions->create();
		$general = $this->getRequest()->getParam('general');
		//$location_on_map = $this->getRequest()->getParam('location_on_map');
		//$store_attribute = $this->getRequest()->getParam('store_attribute');
		if(!empty($general))
		{
			foreach ($general as $key => $value) {
				$model = $this->_dataOptions->create()->load($key, 'option_name');
				if(!empty($model->getData()))
				{
					$model->setOptionValue($value);
					$saveData = $model->save();
				}
				else
				{
					$model->addData([
						"option_name" => $key,
						"option_value" => $value,
						"status" => 1,
						]);
					$saveData = $model->save();
				}
			}	
		}
		
        if($saveData){
            $this->messageManager->addSuccess( __('Settings saved successfully !') );
		}
		$this->_redirect('pilot_smile/options/index');
		
        
	}


}

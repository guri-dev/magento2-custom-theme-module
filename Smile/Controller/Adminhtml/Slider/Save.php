<?php

namespace Pilot\Smile\Controller\Adminhtml\Slider;

use Pilot\Smile\Model\SliderFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;

class Save extends \Magento\Backend\App\Action
{	
	protected $_dataSlider;
	protected $_fileUploaderFactory;
	protected $uploaderFactory;
	protected $filesystem;
	protected $dataPersistor;
	

	public function __construct(
        \Magento\Backend\App\Action\Context $context,
		\Pilot\Smile\Model\SliderFactory  $Slider,
		\Magento\Framework\Image\AdapterFactory $adapterFactory,
		\Magento\Framework\Filesystem $filesystem,
		\Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
		\Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
	)
	{
		$this->uploaderFactory = $uploaderFactory;
		$this->adapterFactory = $adapterFactory;
		$this->_filesystem = $filesystem;
		$this->dataPersistor = $dataPersistor;
        parent::__construct($context);
		$this->_dataSlider = $Slider;
	}

	public function execute()
	{
		
		$model = $this->_dataSlider->create();
		$general = $this->getRequest()->getParam('general');
		$model->addData([
			"slide_title" => $general['slide_title'],
			"slide_description" => $general['slide_description'],
			"slide_image" => isset($general['slider_image'][0]['url']) ? $general['slider_image'][0]['url']:'',
			]);
        $saveData = $model->save();
        if($saveData){
            $this->messageManager->addSuccess( __('Insert Record Successfully !') );
		}
		$this->_redirect('pilot_smile/slider/index');
	}


	public function _filterFoodData(array $rawData)
    {
        //Replace icon with fileuploader field name
        $data = $rawData;
        if (isset($data['icon'][0]['name'])) {
            $data['icon'] = $data['icon'][0]['name'];
        } else {
            $data['icon'] = null;
        }
        return $data;
    }


}

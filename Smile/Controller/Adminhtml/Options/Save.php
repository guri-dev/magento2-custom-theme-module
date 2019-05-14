<?php

namespace Pilot\Smile\Controller\Adminhtml\Slider;

use Pilot\Smile\Model\SliderFactory;
use Pilot\Smile\Model\Slider;
use Pilot\Smile\Api\SliderRepositoryInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{	
    protected $_dataSlider;
    protected $_fileUploaderFactory;
    protected $uploaderFactory;
    protected $filesystem;
    protected $dataPersistor;
    private $sliderRepository;
    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Pilot\Smile\Model\SliderFactory  $Slider,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        SliderRepositoryInterface $sliderRepository = null
    )
    {
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->_filesystem = $filesystem;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
        $this->sliderRepository = $sliderRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(SliderRepositoryInterface::class);
        $this->_dataSlider = $Slider;
    }

	public function execute()
	{	
        $model = $this->_dataSlider->create();
        
        $slide_id = $this->getRequest()->getParam('slide_id');
        $slide_title = $this->getRequest()->getParam('slide_title');
        $slide_description = $this->getRequest()->getParam('slide_description');
        $slider_image = $this->getRequest()->getParam('slider_image');


        if ($slide_id) {            
            $collections = $this->_dataSlider->create()->getCollection()
                 ->addFieldToFilter('slide_id', array('eq' => $slide_id));
            foreach($collections as $item)
            {
                $item->setSlideTitle($slide_title);
                $item->setSlideDescription($slide_description);
                $item->setSlideImage(isset($slider_image[0]['url']) ? $slider_image[0]['url']:'');
            }
            $saveData = $collections->save();
            if($saveData){
                $this->messageManager->addSuccess( __('Record updated Successfully !') );
            }
            $this->_redirect('pilot_smile/slider/index');
            
        }
        else
        {
            
            $model->addData([
                "slide_title" => $slide_title,
                "slide_description" => $slide_description,
                "slide_image" => isset($slider_image[0]['url']) ? $slider_image[0]['url']:'',
                ]);
            $saveData = $model->save();
            if($saveData){
                $this->messageManager->addSuccess( __('Insert Record Successfully !') );
            }
            $this->_redirect('pilot_smile/slider/index');
        }
                
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

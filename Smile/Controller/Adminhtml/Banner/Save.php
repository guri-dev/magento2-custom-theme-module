<?php

namespace Pilot\Smile\Controller\Adminhtml\Banner;

use Pilot\Smile\Model\BannerFactory;
use Pilot\Smile\Model\Banner;
use Pilot\Smile\Api\BannerRepositoryInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{	
    protected $_dataBanner;
    protected $_fileUploaderFactory;
    protected $uploaderFactory;
    protected $filesystem;
    protected $dataPersistor;
    private $bannerRepository;
    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Pilot\Smile\Model\BannerFactory  $Banner,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        BannerRepositoryInterface $bannerRepository = null
    )
    {
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->_filesystem = $filesystem;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
        $this->bannerRepository = $bannerRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(BannerRepositoryInterface::class);
        $this->_dataBanner = $Banner;
    }

	public function execute()
	{	
        $model = $this->_dataBanner->create();
        
        $banner_id = $this->getRequest()->getParam('banner_id');
        $banner_title = $this->getRequest()->getParam('banner_title');
        $banner_description = $this->getRequest()->getParam('banner_description');
        $banner_image = $this->getRequest()->getParam('banner_image');


        if ($banner_id) {            
            $collections = $this->_dataBanner->create()->getCollection()
                 ->addFieldToFilter('banner_id', array('eq' => $banner_id));
            foreach($collections as $item)
            {
                $item->setBannerTitle($banner_title);
                $item->setBannerDescription($banner_description);
                $item->setBannerImage(isset($banner_image[0]['url']) ? $banner_image[0]['url']:'');
            }
            $saveData = $collections->save();
            if($saveData){
                $this->messageManager->addSuccess( __('Record updated Successfully !') );
            }
            $this->_redirect('pilot_smile/banner/index');
            
        }
        else
        {
            
            $model->addData([
                "banner_title" => $banner_title,
                "banner_description" => $banner_description,
                "banner_image" => isset($banner_image[0]['url']) ? $banner_image[0]['url']:'',
                ]);
            $saveData = $model->save();
            if($saveData){
                $this->messageManager->addSuccess( __('Insert Record Successfully !') );
            }
            $this->_redirect('pilot_smile/banner/index');
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

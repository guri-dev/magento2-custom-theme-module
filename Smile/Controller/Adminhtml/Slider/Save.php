<?php

namespace Pilot\Smile\Controller\Adminhtml\Slider;

use Pilot\Smile\Model\SliderFactory;
use Pilot\Smile\Model\Slider;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;

class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{	
	protected $_fileUploaderFactory;
	protected $uploaderFactory;
	protected $filesystem;
	protected $dataPersistor;
	/**
     * @var PostDataProcessor
     */
    protected $dataProcessor;

    /**
     * @var \Magento\Cms\Model\PageFactory
     */
    private $slideFactory;

    /**
     * @var \Magento\Cms\Api\PageRepositoryInterface
     */
    private $slideRepository;
	

	public function __construct(
        \Magento\Backend\App\Action\Context $context,
		\Pilot\Smile\Model\SliderFactory  $slideFactory,
		\Magento\Framework\Image\AdapterFactory $adapterFactory,
		\Magento\Framework\Filesystem $filesystem,
		\Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
		\Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
		\Pilot\Smile\Api\SliderRepositoryInterface $slideRepository = null
	)
	{
		$this->uploaderFactory = $uploaderFactory;
		$this->adapterFactory = $adapterFactory;
		$this->_filesystem = $filesystem;
		$this->dataPersistor = $dataPersistor;
        parent::__construct($context);
		$this->slideFactory = $slideFactory;
		$this->slideRepository = $slideRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()
                ->get(\Pilot\Smile\Api\SliderRepositoryInterface::class);
	}

	public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            //$data = $this->dataProcessor->filter($data);
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = Page::STATUS_ENABLED;
            }
            if (empty($data['page_id'])) {
                $data['page_id'] = null;
            }

            /** @var \Magento\Cms\Model\Page $model */
            $model = $this->slideFactory->create();

            $id = $this->getRequest()->getParam('page_id');
            if ($id) {
                try {
                    $model = $this->pageRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This page no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            $this->_eventManager->dispatch(
                'cms_page_prepare_save',
                ['page' => $model, 'request' => $this->getRequest()]
            );

            // if (!$this->dataProcessor->validate($data)) {
            //     return $resultRedirect->setPath('*/*/edit', ['page_id' => $model->getId(), '_current' => true]);
            // }

            try {
                $this->pageRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the slide.'));
                return $this->processResultRedirect($model, $resultRedirect, $data);
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the page.'));
            }

            $this->dataPersistor->set('cms_page', $data);
            return $resultRedirect->setPath('*/*/edit', ['page_id' => $this->getRequest()->getParam('page_id')]);
        }
        return $resultRedirect->setPath('*/*/');
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

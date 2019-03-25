<?php
namespace Pilot\HelloWorld\Controller\Index;
use  Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\ObjectManagerInterface;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;
    protected $_dir;
	
	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\Framework\Filesystem $filesystem,
        ObjectManagerInterface $objectManager,
        \Magento\Framework\Filesystem\DirectoryList $dir
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        $this->objectManager = $objectManager;
        $this->_dir = $dir;
		return parent::__construct($context);
	}

	public function execute()
	{   
		return $this->_pageFactory->create();
	}
	
	
	public function upload_img()
	{
        try{
            print_r($_FILE); die("okok");
            $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'news_img']);
            $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $imageAdapter = $this->adapterFactory->create();
            /* start of validated image */
            $uploaderFactory->addValidateCallback('custom_image_upload',
                $imageAdapter,'validateUploadFile');
            $uploaderFactory->setAllowRenameFiles(true);
            $uploaderFactory->setFilesDispersion(true);
            $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
            $destinationPath = $mediaDirectory->getAbsolutePath('custom_image');
            $result = $uploaderFactory->save($destinationPath);
            if (!$result) {
                throw new LocalizedException(
                    __('File cannot be saved to path: $1', $destinationPath)
                );
            }
            /* you need yo save image 
                 $result['file'] at datbaseQQ 
            */
            $imagepath = $result['file'];
            print_r($result);
            //
        } catch (\Exception $e) {
            print_r($e);
        }
	}
	
	
}

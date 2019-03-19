<?php
namespace Pilot\HelloWorld\Controller\Index;
use  Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\ObjectManagerInterface;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_newsFactory;
	protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;
    protected $_dir;
	
	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Pilot\HelloWorld\Model\NewsFactory $newsFactory,
		\Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\Framework\Filesystem $filesystem,
        ObjectManagerInterface $objectManager,
        \Magento\Framework\Filesystem\DirectoryList $dir
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->_newsFactory = $newsFactory;
		$this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        $this->objectManager = $objectManager;
        $this->_dir = $dir;
		return parent::__construct($context);
	}

	public function execute()
	{

        if(isset($_POST['news_title']) && $this->getRequest()->getParam('action') == "add_news")
        {
            $news = $this->_newsFactory->create();
            $news->setData('title',$_POST['news_title']);
            $news->setData('post_content',$_POST['post_content']);
            $news->setData('news_url',$_POST['news_url']);
            $news->setData('tags',str_replace(",","_",$_POST['tags']));
            $news->setData('status',1);
            
            try{
            $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'news_img']);
            $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $imageAdapter = $this->adapterFactory->create();
            $uploaderFactory->addValidateCallback('custom_image_upload',
                $imageAdapter,'validateUploadFile');
            $uploaderFactory->setAllowRenameFiles(true);
            $uploaderFactory->setFilesDispersion(true);
            $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
            $destinationPath = $mediaDirectory->getAbsolutePath('news');
            $result = $uploaderFactory->save($destinationPath);
            if (!$result) {
                throw new LocalizedException(
                    __('File cannot be saved to path: $1', $destinationPath)
                );
            }
            
            $imagepath = 'news'.$result['file'];            
            $news->setData('featured_image',$imagepath);
            //
            } catch (\Exception $e) {
                print_r($e);
            }
            
            $news->save();
            
        }
        
        // delete news
        if(isset($_POST['action']) && $_POST['action']=='delete_news')
        {
            
            $id = $this->getRequest()->getParam('news_id');
            try {
                $model = $this->_newsFactory->create();
                $model->load($id);
                $news = $model->getData();
                $news_img = $news['featured_image'];
                $model->delete();                
                if(file_exists($this->_dir->getPath('media')."/".$news_img))
                {
                     unlink($this->_dir->getPath('media')."/".$news_img);   
                }
                echo json_encode(array('news_id' => $id));
                exit;
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        
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

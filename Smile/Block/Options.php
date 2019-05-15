<?php
namespace Pilot\Smile\Block;

/**
 * @api
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @since 100.0.2
 */
class Options extends \Magento\Backend\Block\Widget
{
    /**
     * Tabs
     *
     * @var \Magento\Config\Model\Config\Structure\Element\Iterator
     */
    protected $optionsFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        array $data = [],
        \Pilot\Smile\Model\OptionsFactory  $options
    ) {
        parent::__construct($context, $data);
        $this->optionsFactory = $options;
    }

    public function getOptions()
    {
        $optionsModel = $this->optionsFactory->create();
        $optionsList = $optionsModel->getCollection();
        if(!empty($optionsList->getData()))
        {
                return $optionsList->getData();
        }
        else
        {
                return "no options available";
        }
        
    }
   
    
}

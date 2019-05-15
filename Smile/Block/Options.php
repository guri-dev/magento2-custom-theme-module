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
    protected $_tabs;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }
   
    
}

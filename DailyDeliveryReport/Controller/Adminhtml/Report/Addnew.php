<?php
/** 
 * @package   COP_DailyDeliveryReport
 * @author    Ricky Thakur (Kapil Dev Singh)
 * @copyright Copyright (c) 2018 Ricky Thakur
 * @license   MIT license (see LICENSE.txt for details)
 */
namespace COP\DailyDeliveryReport\Controller\Adminhtml\Report;

use Magento\Backend\App\Action\Context;
use COP\DailyDeliveryReport\Model\EntityFactory;
use Magento\Framework\Controller\ResultFactory;
    
class Addnew extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'COP_DailyDeliveryReport::entity';

    
    /**
     * @var \COP\DailyDeliveryReport\Model\EntityFactory
     */
    private $entityFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \COP\DailyDeliveryReport\Model\EntityFactory $entityFactory
     */
    public function __construct(
        Context $context,
        EntityFactory $entityFactory
    ) {
        parent::__construct($context);
        $this->entityFactory = $entityFactory;            
    }
    

    /**
     * Create new Entity
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {   
        
        $this->entityFactory->create();
        
        
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('COP_DailyDeliveryReport::first_level_menu');
        
        $title = "Daily Delivery Report Information";
        
        $resultPage->getConfig()->getTitle()->prepend($title);
        
        return $resultPage;
    }
}  
<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace COP\DailyDeliveryReport\Controller\Adminhtml\Report;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Edit extends \Magento\Backend\App\Action
{
    /**
         * Authorization level of a basic admin session
         *
         * @see _isAllowed()
         */
        const ADMIN_RESOURCE = 'COP_DailyDeliveryReport::entity';

        /**
         * @var \Magento\Framework\Registry
         */
        private $coreRegistry;
    
        /**
         * @var \COP\DailyDeliveryReport\Model\EntityFactory
         */
        private $entityFactory;
    
        /**
         * @param \Magento\Backend\App\Action\Context $context
         * @param \Magento\Framework\Registry $coreRegistry,
         * @param \COP\DailyDeliveryReport\Model\EntityFactory $entityFactory
         */
        public function __construct(
            \Magento\Backend\App\Action\Context $context,
            \Magento\Framework\Registry $coreRegistry,
            \COP\DailyDeliveryReport\Model\EntityFactory $entityFactory
        ) {
            parent::__construct($context);
            $this->coreRegistry = $coreRegistry;
            $this->entityFactory = $entityFactory; 
        }
    
       
        public function execute()
        {
            $rowId = (int) $this->getRequest()->getParam('id');
            $rowData = $this->entityFactory->create();
            
            
            if ($rowId) {
                $rowData = $rowData->load($rowId);
            
                if (!$rowData->getEntityId()) {
                    $this->messageManager->addError(__('row data no longer exist.'));
                    $this->_redirect('*/*/index');
                    return;
                }
            }
    
            $this->coreRegistry->register('row_data', $rowData);
            $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $resultPage->setActiveMenu('COP_DailyDeliveryReport::first_level_menu');
            $title = "Daily Delivery Report Information";
            $resultPage->getConfig()->getTitle()->prepend($title);
            return $resultPage;
        }
    
      
    }
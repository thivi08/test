<?php
/** 
 * @package   COP_DailyDeliveryReport
 * @author    Ricky Thakur (Kapil Dev Singh)
 * @copyright Copyright (c) 2018 Ricky Thakur
 * @license   MIT license (see LICENSE.txt for details)
 */
    namespace COP\DailyDeliveryReport\Controller\Adminhtml\Report;

    class Index extends \Magento\Backend\App\Action
    {
        /**
         * Authorization level of a basic admin session
         *
         * @see _isAllowed()
         */
        const ADMIN_RESOURCE = 'COP_DailyDeliveryReport::entity';

        /**
        * @var \Magento\Framework\View\Result\PageFactory
        */
        protected $resultPageFactory;

        /**
         * Constructor
         *
         * @param \Magento\Backend\App\Action\Context $context
         * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
         */
        public function __construct(
            \Magento\Backend\App\Action\Context $context,
            \Magento\Framework\View\Result\PageFactory $resultPageFactory
        ) {
                parent::__construct($context);
                $this->resultPageFactory = $resultPageFactory;
        }

        /**
         * Load the page defined in view/adminhtml/layout/dailydeliveryreport_report_index.xml
         *
         * @return \Magento\Framework\View\Result\Page
         */
        public function execute()
        {
            $resultPage = $this->resultPageFactory->create();
            $resultPage->setActiveMenu('COP_DailyDeliveryReport::first_level_menu');

            $resultPage->getConfig()->getTitle()->prepend((__('Daily Delivery Report')));

            return $resultPage;
        }
        
    }
?>
  
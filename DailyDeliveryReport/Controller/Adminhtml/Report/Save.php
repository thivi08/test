<?php
/** 
 * @package   COP_DailyDeliveryReport
 * @author    Ricky Thakur (Kapil Dev Singh)
 * @copyright Copyright (c) 2018 Ricky Thakur
 * @license   MIT license (see LICENSE.txt for details)
 */

namespace COP\DailyDeliveryReport\Controller\Adminhtml\Report;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use COP\DailyDeliveryReport\Model\EntityFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Session\SessionManagerInterface;

class Save extends Action
{

    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'COP_DailyDeliveryReport::entity';

    /**
     * @var EntityFactory
    */
    protected $_entityFactory;
    
    /**
     * @var PageFactory
    */
    protected $resultPageFactory;

    /**
     * @var SessionManagerInterface
    */
    protected $_sessionManager;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory,
     * @param \COP\DailyDeliveryReport\Model\EntityFactory $entityFactory,
     * @param \Magento\Framework\Session\SessionManagerInterface $sessionManager
     */
    public function __construct(
        Context $context,
        EntityFactory $entityFactory,
        PageFactory  $resultPageFactory,
        SessionManagerInterface $sessionManager
    )
    {
        parent::__construct($context);
        $this->_entityFactory = $entityFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->_sessionManager = $sessionManager;
        
    }
    
    /**
     * Save action
    */
    public function execute()
    {   
        $resultRedirect     = $this->resultRedirectFactory->create();
        $entityModel        = $this->_entityFactory->create();
        $data               = $this->getRequest()->getPost(); 
        
        try{
            if (!empty($data['id'])) {
                $entityModel->setEntityId($data['id']);
            }

            //get delivery date
//            $gendate = new DateTime();
//            $gendate->setISODate($data["year"], $data["week_no"], $data["day"]);
            $timestamp    = strtotime($data["year"] . '-W' . $data["week_no"] . '-' . $data["day"]);
            $delivery_date =  date('d-m-Y', $timestamp);

            // set data for report
            $report_data = array(
                "report_name"=>"Daily Meal Delivered - ".date("d/m/y"),
                "report_date" =>date("d/m/y"),
                "delivery_date" =>$delivery_date
                );
            $entityModel->setData($report_data);
            $entityModel->save();

            //check for `back` parameter
            if ($this->getRequest()->getParam('back')) { 
                return $resultRedirect->setPath('*/*/edit', ['id' => $entityModel->getId(), '_current' => true, '_use_rewrite' => true]);
            }

            $this->_redirect('*/*');
            $this->messageManager->addSuccess(__('The Report has been saved.'));

        }catch(\Exception $e){
            $this->messageManager->addError(__($e->getMessage()));
        }        
        
    }
}
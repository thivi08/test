<?php
/** 
 * @package   COP_DailyDeliveryReport
 * @author    Ricky Thakur (Kapil Dev Singh)
 * @copyright Copyright (c) 2018 Ricky Thakur
 * @license   MIT license (see LICENSE.txt for details)
 */
namespace COP\DailyDeliveryReport\Controller\Adminhtml\Report;

use COP\DailyDeliveryReport\Model\Entity as Entity;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'COP_DailyDeliveryReport::entity';

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\COP\DailyDeliveryReport\Model\Entity::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccess(__('Report has been deleted.'));
                // go to grid
                
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find entity to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    
    }
    
}

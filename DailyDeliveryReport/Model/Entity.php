<?php
/** 
 * @package   COP_DailyDeliveryReport
 * @author    Ricky Thakur (Kapil Dev Singh)
 * @copyright Copyright (c) 2018 Ricky Thakur
 * @license   MIT license (see LICENSE.txt for details)
 */
namespace COP\DailyDeliveryReport\Model;


class Entity extends \Magento\Framework\Model\AbstractModel
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'modulename_records';

    /**
     * @var string
     */
    protected $_cacheTag = 'modulename_records';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'modulename_records';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('COP\DailyDeliveryReport\Model\ResourceModel\Entity');
    }

    /**
     * @return mixed
     */
    public function getEntityId()
    {
        return $this->getData('id');
    }


    public function getDeliveryDate()
    {
        return $this->getData('delivery_date');
    }


}

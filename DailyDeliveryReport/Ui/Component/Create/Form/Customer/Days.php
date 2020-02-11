<?php
namespace COP\DailyDeliveryReport\Ui\Component\Create\Form\Customer;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\App\RequestInterface;

/**
 * Class Options
 * @package COP\Dislikes\Ui\Component\Create\Form\Customer
 */
class Days implements OptionSourceInterface
{


    /**
     * @var RequestInterface
     */
    protected $request;


    /**
     * Options constructor.
     * @param Data $ingredientCollectionFactory
     * @param RequestInterface $request
     */
    public function __construct(
        RequestInterface $request
    ) {
        $this->request = $request;
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return $this->getDays();
    }

    /**
     * Retrieve Ingredient Tree
     *
     * @return array
     */
    protected function getDays()
    {
        $days = array(
            0=> array("label"=> "Monday","value"=>1),
            1=> array("label"=> "Tuesday","value"=>2),
            2=> array("label"=> "Wednesday","value"=>3),
            3=> array("label"=> "Thursday","value"=>4),
            4=> array("label"=> "Friday","value"=>5)
        );
        return $days;
    }
}

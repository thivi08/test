<?php
namespace COP\DailyDeliveryReport\Ui\Component\Create\Form\Customer;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\App\RequestInterface;

/**
 * Class Options
 * @package COP\Dislikes\Ui\Component\Create\Form\Customer
 */
class Years implements OptionSourceInterface
{


    /**
     * @var RequestInterface
     */
    protected $request;


    /**
     * Options constructor.
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
        return $this->getYears();
    }

    /**
     * Retrieve Ingredient Tree
     *
     * @return array
     */
    protected function getYears()
    {
        $years = array();
        for($y=date("Y")-5; $y<=date("Y"); $y++){
            $years [] = array("label"=>"$y", "value"=>"$y");
        }

        return $years;
    }
}

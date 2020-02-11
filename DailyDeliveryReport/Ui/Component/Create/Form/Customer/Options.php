<?php
namespace COP\DailyDeliveryReport\Ui\Component\Create\Form\Customer;

use COP\Runnumbers\Helper\Data;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\App\RequestInterface;

/**
 * Class Options
 * @package COP\Dislikes\Ui\Component\Create\Form\Customer
 */
class Options implements OptionSourceInterface
{
    /**
     * @var RunnumberCollectionFactory
     */
    protected $runnumberCollectionFactory;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var array
     */
    protected $runnumberTree;

    /**
     * Options constructor.
     * @param Data $ingredientCollectionFactory
     * @param RequestInterface $request
     */
    public function __construct(
        Data $runnumberCollectionFactory,
        RequestInterface $request
    ) {
        $this->runnumberCollectionFactory = $runnumberCollectionFactory;
        $this->request = $request;
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return $this->getIngredientTree();
    }

    /**
     * Retrieve Ingredient Tree
     *
     * @return array
     */
    protected function getIngredientTree()
    {
        if ($this->runnumberTree === null) {
            $collection = $this->runnumberCollectionFactory->getRunNumbers();

            $ingredientById[0]['label']= "All Run Numbers";
            $ingredientById[0]['value']= 0;
            foreach ($collection as $ingredient) {
                $ingredientId = $ingredient->getId();
                if (!isset($ingredientById[$ingredientId])) {
                    $ingredientById[$ingredientId] = [
                        'value' => $ingredientId
                    ];
                }
                $ingredientById[$ingredientId]['label'] = $ingredient->getRunNumber();
            }
            $this->runnumberTree = $ingredientById;
        }
        return $this->runnumberTree;
    }
}

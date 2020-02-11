<?php
namespace COP\DailyDeliveryReport\Block\Adminhtml\Gismap;

use COP\DailyDeliveryReport\Model\EntityFactory;
use Magento\Framework\View\Element\Template;

class Map extends \Magento\Framework\View\Element\Template
{

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $request;

    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
    protected $_orderCollectionFactory;

    /**
     * @var EntityFactory
     */
    protected $_entityFactory;

    /**
     * @var \Magento\Sales\Model\OrderRepository
     */
    protected $orderRepository;

    public function __construct(
        Template\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Magento\Sales\Model\OrderRepository $orderRepository,
        EntityFactory $entityFactory,
        array $data = []
    ) {
        $this->request = $request;
        $this->_entityFactory = $entityFactory;
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->orderRepository =$orderRepository;
        parent::__construct($context, $data);
    }

    public function getAllOrders()
    {
        //get delivery date from parameter id
        $id = $this->request->getParam('id');
        $entityModel = $this->_entityFactory->create();

        //get all orders - need to change
        $orderCollection = $this->_orderCollectionFactory->create();

        $orders = [];
        foreach ($orderCollection as $order) {
            $orders[] = $order->getId();
        }

        return $orders;
    }

    public function getShippingAdress()
    {
        $order_ids = $this->getAllOrders();

        $details = [];
        foreach ($order_ids as $ord) {
            $order = $this->orderRepository->get($ord);
            $data = $order->getShippingAddress()->getData();
            $details[] = [
                "region_id" =>$data["region_id"],
                "region" =>$data["region"],
                "postcode" =>$data["postcode"],
                "street" =>$data["street"],
                "city" =>$data["city"],
                "country_id" =>$data["country_id"]
            ];
        }
        return $details;
    }
}

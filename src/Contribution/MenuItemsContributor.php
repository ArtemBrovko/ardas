<?php


namespace App\Contribution;

use App\Controller\ProductAttributeController;
use App\Controller\ProductController;
use App\Menu\MenuEntityItem;
use App\Menu\MenuItemInterface;
use Symfony\Component\Routing\RouterInterface;

class MenuItemsContributor
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * MenuItemsContributor constructor.
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @return MenuItemInterface[]
     */
    public function getItems()
    {
        return [
            new MenuEntityItem(
                'Products',
                $this->router->generate('product_index'),
                ProductController::class
            ),
            new MenuEntityItem(
                'Attributes',
                $this->router->generate('product_attribute_index'),
                ProductAttributeController::class
            ),
        ];
    }
}
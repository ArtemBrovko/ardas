<?php

namespace App\Services;

use App\Contribution\MenuItemsContributor;
use App\Controller\ProductController;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Environment;

class MenuService
{
    /**
     * @var MenuItemsContributor[]
     */
    private $menuItemsContributors = [];

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * MenuService constructor.
     * @param Environment $twig
     * @param RequestStack $requestStack
     */
    public function __construct(Environment $twig, RequestStack $requestStack)
    {
        $this->twig = $twig;
        $this->requestStack = $requestStack;
    }

    /**
     * @param $menuItemsContributor
     */
    public function addMenuItemsContributor(MenuItemsContributor $menuItemsContributor)
    {
        $this->menuItemsContributors[] = $menuItemsContributor;
    }

    public function render()
    {
        $request = $this->requestStack->getCurrentRequest();

        $items = [];

        foreach ($this->menuItemsContributors as $itemsContributor) {
            foreach ($itemsContributor->getItems() as $menuItem) {
                $items[] = [
                    'title' => $menuItem->getTitle(),
                    'link' => $menuItem->getLink(),
                    'active' => $menuItem->isActive($request),
                ];
            }
        }

        return $this->twig->render('menu/menu.twig', [
            'items' => $items,
            'query' => $request->query->has(ProductController::PRODUCT_QUERY_PARAMETER) ? $request->query->get(ProductController::PRODUCT_QUERY_PARAMETER) : ''
        ]);
    }
}
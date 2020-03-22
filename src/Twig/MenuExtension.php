<?php

namespace App\Twig;

use App\Services\MenuService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MenuExtension extends AbstractExtension
{
    /**
     * @var MenuService
     */
    private $menuService;

    /**
     * MenuExtension constructor.
     * @param MenuService $menuService
     */
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('render_menu', array($this->menuService, 'render'), ['is_safe' => ['html']])
        ];
    }
}
<?php

namespace App\Menu;

use Symfony\Component\HttpFoundation\Request;

class MenuEntityItem implements MenuItemInterface
{
    private $title;
    private $link;
    private $controller;

    /**
     * MenuEntityItem constructor.
     * @param $title
     * @param $link
     * @param $controller
     */
    public function __construct($title, $link, $controller)
    {
        $this->title = $title;
        $this->link = $link;
        $this->controller = $controller;
    }


    public function getTitle()
    {
        return $this->title;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function isActive(Request $request)
    {
        if ($request->attributes->has('_controller')) {
            return strpos($request->attributes->get('_controller'), $this->controller . '::') !== false;
        } else {
            return false;
        }
    }

}
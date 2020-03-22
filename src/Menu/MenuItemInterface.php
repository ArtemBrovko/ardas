<?php

namespace App\Menu;

use Symfony\Component\HttpFoundation\Request;

interface MenuItemInterface
{
    public function getTitle();
    public function getLink();
    public function isActive(Request $request);
}
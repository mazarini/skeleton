<?php

namespace App\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\HttpFoundation\Request;

class CssExtensionRuntime implements RuntimeExtensionInterface
{
    public function getBodyClass(Request $request): string
    {
        $url = trim($request->getPathInfo(), '/');
        if (substr($url, 0, 5) !== 'admin') {
            $url = trim('front/' . $url, '/');
        }
        $elements = explode('/', $url);
        if (isset($elements[0])) {
            $class[] = $elements[0];
        }
        if (isset($elements[1])) {
            $class[] = $elements[1];
        }
        $class[] = $request->get('_route');
        return implode(' ', $class);
    }
}

<?php
use illuminate\Support\Facades\Route;


if (!function_exists('set_active_route')) {
    function set_active_route($route_name, $active_class = 'is-active', $inactive_class = '', $additional_class = '') {
        $classes = '';
        $current_route = Route::currentRouteName();
        // return $current_route;
        if (strpos($current_route, $route_name) === 0) {
            $classes .= $active_class . ' ' . $additional_class;
        } else {
            $classes .= $inactive_class;
        }
    
        return $classes;
    }
    
}

if (!function_exists('calculateTotalPrice')) {
    function calculateTotalPrice($fare, $fuelSurcharge) {
        return $fare + $fuelSurcharge;
    }
    
    
}

if (!function_exists('formatDuration')) {
    function formatDuration($duration)
    {
        $formatted = \Carbon\CarbonInterval::fromString($duration)->cascade()->forHumans();

        // Replace days, hours, and minutes with d, h, and m
        $formatted = str_replace('days', 'd', $formatted);
        $formatted = str_replace('day', 'd', $formatted);
        $formatted = str_replace('hours', 'h', $formatted);
        $formatted = str_replace('hour', 'h', $formatted);
        $formatted = str_replace('minutes', 'm', $formatted);
        $formatted = str_replace('minute', 'm', $formatted);

        return $formatted;
    }
}


if (!function_exists('formatTime')) {
    function formatTime($dateTime, $format = 'H:i')
    {
        return \Carbon\Carbon::parse($dateTime)->format($format);
    }
}

if (!function_exists('getContactDetails')) {
    function getContactDetails()
    {
        return \App\Models\ContactDetail::first();
    }
}


if (!function_exists('getSocialMediaIconClass')) {
    function getSocialMediaIconClass($platform)
    {
        $platforms = [
            'facebook' => 'fab fa-facebook-f',
            'twitter' => 'fab fa-twitter',
            'instagram' => 'fab fa-instagram',
            'linkedin' => 'fab fa-linkedin-in',
            // Add more platforms as needed
        ];

        return $platforms[$platform] ?? '';
    }
}

if (!function_exists('getSiteIdentity')) {
    function getSiteIdentity()
    {
        return \App\Models\identity::first();
    }
}

if (!function_exists('getSectionContent')) {
    function getSectionContent($type)
    {
        return \App\Models\SectionsContent::where('section_type',$type)->first();
    }
}
 
// app/helpers.php

if (!function_exists('getCurrencySymbol')) {
    /**
     * Get currency symbol based on currency code.
     *
     * @param string $currencyCode
     * @return string|null
     */
    function getCurrencySymbol($currencyCode)
    {
        $symbols = [
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
            
        ];

        return $symbols[strtoupper($currencyCode)] ?? null;
    }
}


?>
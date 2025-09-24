<?php namespace App\Helpers;

class ViewHelpers
{
    /**
     * Get category icon safely
     */
    public static function getCategoryIcon($category)
    {
        $icons = [
            'language' => 'code',
            'framework' => 'cogs', 
            'tool' => 'tools',
            'soft_skill' => 'brain'
        ];
        return $icons[$category] ?? 'code';
    }
    
    /**
     * Get event type color safely
     */
    public static function getEventTypeColor($type)
    {
        $colors = [
            'hackathon' => 'warning',
            'conference' => 'info',
            'workshop' => 'success',
            'competition' => 'danger',
            'meetup' => 'primary'
        ];
        return $colors[$type] ?? 'secondary';
    }
}

// Fonctions globales pour faciliter l'utilisation dans les vues
if (!function_exists('get_category_icon')) {
    function get_category_icon($category) {
        return \App\Helpers\ViewHelpers::getCategoryIcon($category);
    }
}

if (!function_exists('get_event_type_color')) {
    function get_event_type_color($type) {
        return \App\Helpers\ViewHelpers::getEventTypeColor($type);
    }
}
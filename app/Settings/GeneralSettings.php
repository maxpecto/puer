<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings
{
    public string $site_name = 'Chaai - Organic Tea Shop';
    public ?string $site_logo_header = null;
    public ?string $site_logo_footer = null;
    public ?string $footer_address = null;
    public ?string $footer_phone = null;
    public ?string $footer_email = null;
    public ?string $working_hours_weekdays = null;
    public ?string $working_hours_weekend = null;
    public ?string $facebook_url = null;
    public ?string $instagram_url = null;
    public ?string $twitter_url = null;
    public ?string $pinterest_url = null;
    public ?string $hero_title = null;
    public ?string $hero_subtitle = null;
    public ?string $hero_background_image = null;
    public ?string $meta_title = null;
    public ?string $meta_description = null;
    public ?string $meta_keywords = null;
    public ?string $linkedin_url = null;
    public ?string $youtube_url = null;
    public ?string $contact_form_email = null;
    public ?string $google_maps_iframe = null;
    public ?string $google_analytics_id = null;
    public ?string $facebook_pixel_id = null;
    public bool $maintenance_mode = false;
    public ?string $default_product_image = null;
    public ?string $primary_color = '#000000';
    public ?string $secondary_color = '#FFFFFF';
    public ?string $featured_products_title = 'Unique Tea Blends';
    public ?string $featured_products_subtitle = 'Discover our handpicked selection...';
    public ?string $shop_page_url = '/shop';
    public ?string $view_all_products_button_text = 'View All Teas';
    public ?string $popular_offers_title = 'Special Offers Just For You';
    public ?string $popular_offers_subtitle = 'Don\'t miss out on our exclusive deals...';
    public ?string $testimonials_title = 'What Our Customers Say';
    public ?string $testimonials_subtitle = 'Honest feedback from our valued tea lovers.';
    public ?string $instagram_gallery_title = 'Follow Us on Instagram';
    public ?string $instagram_gallery_subtitle = 'Get inspired by our latest posts...';
    public ?string $instagram_handle = 'ChaaiPuerh';
    public ?string $hero_button_link = '#shop';
    public ?string $hero_button_text = 'Shop Now';
    public ?string $whatsapp_number = null;

    /**
     * Tüm ayar özelliklerini ve varsayılan değerlerini bir dizi olarak döndürür.
     */
    public function getDefaults(): array
    {
        $defaults = [];
        $reflection = new \ReflectionClass($this);
        foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            // Başlatılmamış (uninitialized) özellikler için PHP 8'de hata almamak adına kontrol
            if ($property->isInitialized($this)) {
                $defaults[$property->getName()] = $property->getValue($this);
            }
        }
        return $defaults;
    }
}
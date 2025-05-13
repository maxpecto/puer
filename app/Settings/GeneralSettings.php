<?php

namespace App\Settings;

// use Spatie\LaravelSettings\Settings; // Artıq istifadə edilmir

class GeneralSettings // `extends Settings` silindi
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
    public ?string $primary_color = '#E2725B'; // Terrakota
    public ?string $secondary_color = '#8B4513'; // Qəhvəyi - SaddleBrown
    public ?string $text_color = '#36454F'; // Tünd Boz - Charcoal
    public ?string $text_light_color = '#FFFFFF'; // Ağ qalır
    public ?string $background_color = '#FFFDD0'; // Krem Rəngi
    public ?string $surface_color = '#F5F5DC'; // Açıq Bej
    public ?string $accent_color = '#FBCEB1'; // Ərik Rəngi / Açıq Şaftalı
    public ?string $header_bg_color = '#F5F5DC'; // Açıq Bej - Səth Rəngi
    public ?string $header_text_color = '#36454F'; // Tünd Boz
    public ?string $footer_bg_color = '#36454F'; // Tünd Boz - Mətn Rəngi
    public ?string $footer_text_color = '#FFFDD0'; // Krem Rəngi - Arxaplan Rəngi
    public ?string $button_primary_bg_color = '#E2725B'; // Terrakota
    public ?string $button_primary_text_color = '#FFFDD0'; // Krem Rəngi
    public ?string $button_secondary_bg_color = '#F5F5DC'; // Açıq Bej
    public ?string $button_secondary_text_color = '#36454F'; // Tünd Boz
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

    public ?string $mapbox_api_key = '';
    public ?float $mapbox_longitude = null;
    public ?float $mapbox_latitude = null;
    public ?int $mapbox_zoom_level = 10;
    public ?string $mapbox_style_url = 'mapbox://styles/mapbox/streets-v11';

    // Header üçün ek renk ayarları
    public ?string $header_link_color = '#E2725B'; // Terrakota - Əsas Rəng
    public ?string $header_link_hover_color = '#8B4513'; // Qəhvəyi - İkinci Rəng
    public ?string $header_icon_color = '#36454F'; // Tünd Boz
    public ?string $header_icon_hover_color = '#E2725B'; // Terrakota - Əsas Rəng
    public ?string $mobile_menu_bg_color = '#F5F5DC'; // Açıq Bej
    public ?string $mobile_menu_link_color = '#E2725B'; // Terrakota
    public ?string $mobile_menu_link_hover_bg_color = '#FBCEB1'; // Ərik Rəngi
    public ?string $mobile_menu_link_hover_text_color = '#36454F'; // Tünd Boz
    public ?string $cart_badge_bg_color = '#E2725B'; // Terrakota
    public ?string $cart_badge_text_color = '#FFFDD0'; // Krem Rəngi

    // Mobil menü butonu için ek renk ayarları
    public ?string $mobile_menu_button_color = '#36454F'; // Tünd Boz
    public ?string $mobile_menu_button_hover_color = '#E2725B'; // Terrakota

    // Footer üçün ek renk ayarları
    public ?string $footer_secondary_text_color = '#FBCEB1'; // Ərik Rəngi
    public ?string $footer_link_hover_color = '#E2725B'; // Terrakota
    public ?string $footer_border_color = '#8B4513'; // Qəhvəyi

    // Əlaqə Səhifəsi üçün Xüsusi Rəng Ayarları (Ümumi)
    public ?string $contact_info_secondary_color = '#8B4513'; // Qəhvəyi
    public ?string $contact_social_icon_color = '#8B4513';    // Qəhvəyi
    public ?string $contact_social_icon_hover_color = '#E2725B'; // Terrakota
    public ?string $contact_label_color = null;
    public ?string $contact_title_color = null;

    // Əlaqə Səhifəsi - Mesaj Formu İnputları üçün Sadələşdirilmiş Rəng Ayarları
    public ?string $contact_form_input_background_color = '#FFFDD0'; // Krem Rəngi
    public ?string $contact_form_input_text_color = '#36454F'; // Tünd Boz
    public ?string $contact_form_input_border_color = '#8B4513'; // Qəhvəyi
    public ?string $contact_form_input_focus_color = '#E2725B'; // Terrakota

    /**
     * Tüm ayar özelliklerini ve varsayılan değerlerini bir dizi olarak döndürür.
     */
    public function getDefaults(): array
    {
        $defaults = [];
        $reflection = new \ReflectionClass($this);
        foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if ($property->isInitialized($this)) {
                $defaults[$property->getName()] = $property->getValue($this);
            }
        }
        return $defaults;
    }
}
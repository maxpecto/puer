<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Artisan;
use Filament\Notifications\Notification;
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;

class ManageSiteSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Admin';
    protected static string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $defaultSettings = (new GeneralSettings())->getDefaults();
        $dbSettings = [];
        $settingsRecord = DB::table('settings')->where('group', 'general')->where('name', 'general')->first();

        if ($settingsRecord && !empty($settingsRecord->payload)) {
            $dbSettings = json_decode($settingsRecord->payload, true) ?: [];
        }
        $this->data = array_merge($defaultSettings, $dbSettings);
        $this->form->fill($this->data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Settings Tabs')
                    ->tabs([
                        Tabs\Tab::make('Genel Bilgiler')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextInput::make('site_name')
                                    ->label('Site Adı')
                                    ->required(),
                                FileUpload::make('site_logo_header')
                                    ->label('Site Logosu (Header)')
                                    ->image()
                                    ->directory('setting-images'),
                                FileUpload::make('site_logo_footer')
                                    ->label('Site Logosu (Footer)')
                                    ->image()
                                    ->directory('setting-images'),
                                Section::make('Ana Sayfa Başlıkları ve Butonları')
                                    ->description('Ana sayfadaki çeşitli bölümlerin başlıkları ve buton metinleri.')
                                    ->schema([
                                        TextInput::make('hero_button_link')->label('Hero Buton Linki'),
                                        TextInput::make('hero_button_text')->label('Hero Buton Metni'),
                                        TextInput::make('featured_products_title')->label('Öne Çıkan Ürünler Başlığı'),
                                        Textarea::make('featured_products_subtitle')->label('Öne Çıkan Ürünler Alt Başlığı')->rows(2),
                                        TextInput::make('shop_page_url')->label('Mağaza Sayfası URL'),
                                        TextInput::make('view_all_products_button_text')->label('Tüm Ürünleri Gör Buton Metni'),
                                        TextInput::make('popular_offers_title')->label('Popüler Teklifler Başlığı'),
                                        Textarea::make('popular_offers_subtitle')->label('Popüler Teklifler Alt Başlığı')->rows(2),
                                        TextInput::make('testimonials_title')->label('Müşteri Yorumları Başlığı'),
                                        Textarea::make('testimonials_subtitle')->label('Müşteri Yorumları Alt Başlığı')->rows(2),
                                        TextInput::make('instagram_gallery_title')->label('Instagram Galeri Başlığı'),
                                        Textarea::make('instagram_gallery_subtitle')->label('Instagram Galeri Alt Başlığı')->rows(2),
                                        TextInput::make('instagram_handle')->label('Instagram Kullanıcı Adı'),
                                    ])->columns(2),
                            ]),
                        Tabs\Tab::make('Hero Alanı')
                            ->icon('heroicon-o-sparkles')
                            ->schema([
                                TextInput::make('hero_title')
                                    ->label('Hero Başlık'),
                                Textarea::make('hero_subtitle')
                                    ->label('Hero Alt Başlık'),
                                FileUpload::make('hero_background_image')
                                    ->label('Hero Arkaplan Görseli')
                                    ->image()
                                    ->directory('setting-images'),
                            ]),
                        Tabs\Tab::make('Alt Bilgi & İletişim')
                            ->icon('heroicon-o-phone-arrow-down-left')
                            ->schema([
                                Section::make('Alt Bilgi')
                                    ->schema([
                                        Textarea::make('footer_address')
                                            ->label('Adres (Alt Bilgi)'),
                                        TextInput::make('footer_phone')
                                            ->label('Telefon (Alt Bilgi)'),
                                        TextInput::make('footer_email')
                                            ->label('E-posta (Alt Bilgi)')
                                            ->email(),
                                        TextInput::make('working_hours_weekdays')
                                            ->label('Çalışma Saatleri (Hafta İçi)'),
                                        TextInput::make('working_hours_weekend')
                                            ->label('Çalışma Saatleri (Hafta Sonu)'),
                                        TextInput::make('whatsapp_number')
                                            ->label(__('WhatsApp Number'))
                                            ->placeholder(__('Country Code + Number, e.g., 994XXXXXXXXX'))
                                            ->tel(),
                                    ])->columns(2),
                                Section::make('İletişim Formu & Harita')
                                    ->schema([
                                        TextInput::make('contact_form_email')
                                            ->label('İletişim Formu Alıcı E-postası')
                                            ->email(),
                                    ])->columns(1),
                                Section::make('Xəritə Ayarları')
                                    ->description('Saytdakı xəritə üçün ayarlar. Mapbox və ya Google Maps istifadə edə bilərsiniz.')
                                    ->schema([
                                        TextInput::make('mapbox_api_key')
                                            ->label('Mapbox API Açarınız')
                                            ->password()
                                            ->hint('Mapbox hesabınızdan əldə edin.'),
                                        TextInput::make('mapbox_style_url')
                                            ->label('Mapbox Stil URL')
                                            ->placeholder('mapbox://styles/mapbox/streets-v11')
                                            ->helperText('Boş buraxsanız defolt stil istifadə ediləcək.'),
                                        TextInput::make('mapbox_latitude')
                                            ->label('Məkan Enliyi (Latitude)')
                                            ->id('mapbox_latitude_input')
                                            ->numeric()
                                            ->rules(['regex:/^[-]?(([0-8]?[0-9])(\\.[0-9]+)?|90(\\.0+)?)$/'])
                                            ->placeholder('Məs: 40.3790'),
                                        TextInput::make('mapbox_longitude')
                                            ->label('Məkan Uzunluğu (Longitude)')
                                            ->id('mapbox_longitude_input')
                                            ->numeric()
                                            ->rules(['regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))(\\.[0-9]+)?)|180(\\.0+)?)$/'])
                                            ->placeholder('Məs: 49.8533'),
                                        TextInput::make('mapbox_zoom_level')
                                            ->label('Xəritə Böyütmə Səviyyəsi')
                                            ->numeric()
                                            ->minValue(1)
                                            ->maxValue(22)
                                            ->placeholder('Məs: 12'),
                                        
                                        \Filament\Forms\Components\View::make('filament.forms.components.mapbox-admin-picker')
                                            ->columnSpanFull(),

                                        Textarea::make('google_maps_iframe')
                                            ->label('Google Haritalar Iframe Kodu (Alternativ)')
                                            ->rows(3)
                                            ->helperText('Mapbox yerinə Google Maps istifadə etmək istəyirsinizsə.'),
                                    ])->columns(2),
                            ]),
                        Tabs\Tab::make('Sosyal Medya')
                            ->icon('heroicon-o-share')
                            ->schema([
                                TextInput::make('facebook_url')->label('Facebook URL')->url(),
                                TextInput::make('instagram_url')->label('Instagram URL')->url(),
                                TextInput::make('twitter_url')->label('Twitter URL')->url(),
                                TextInput::make('pinterest_url')->label('Pinterest URL')->url(),
                                TextInput::make('linkedin_url')->label('LinkedIn URL')->url(),
                                TextInput::make('youtube_url')->label('YouTube URL')->url(),
                            ])->columns(2),
                        Tabs\Tab::make('SEO Ayarları')
                            ->icon('heroicon-o-magnifying-glass-circle')
                            ->schema([
                                TextInput::make('meta_title')
                                    ->label('Meta Başlık (Title)'),
                                Textarea::make('meta_description')
                                    ->label('Meta Açıklama (Description)')
                                    ->rows(3),
                                TextInput::make('meta_keywords')
                                    ->label('Meta Anahtar Kelimeler (Virgülle ayırın)'),
                            ]),
                        Tabs\Tab::make('Gelişmiş Ayarlar')
                            ->icon('heroicon-o-wrench-screwdriver')
                            ->schema([
                                Toggle::make('maintenance_mode')
                                    ->label('Bakım Modu Aktif'),
                                FileUpload::make('default_product_image')
                                    ->label('Varsayılan Ürün Görseli')
                                    ->image()
                                    ->directory('setting-images'),
                                Section::make('Analitik Kodları')
                                    ->description('İlgili platformlardan aldığınız takip IDlerini girin.')
                                    ->schema([
                                        TextInput::make('google_analytics_id')
                                            ->label('Google Analytics ID'),
                                        TextInput::make('facebook_pixel_id')
                                            ->label('Facebook Pixel ID'),
                                    ])->columns(2),
                                Section::make('Site Renkleri')
                                    ->schema([
                                        ColorPicker::make('primary_color')
                                            ->label('Ana Renk (Primary Color)'),
                                        ColorPicker::make('secondary_color')
                                            ->label('İkincil Renk (Secondary Color)'),
                                        ColorPicker::make('text_color')
                                            ->label('Genel Metin Rengi'),
                                        ColorPicker::make('text_light_color')
                                            ->label('Açık Zemin Metin Rengi (Koyu Arkaplan İçin)'),
                                        ColorPicker::make('background_color')
                                            ->label('Genel Arkaplan Rengi'),
                                        ColorPicker::make('surface_color')
                                            ->label('Yüzey Rengi (Kart vb.)'),
                                        ColorPicker::make('accent_color')
                                            ->label('Vurgu Rengi (Linkler vb.)'),
                                        ColorPicker::make('header_bg_color')
                                            ->label('Header Arkaplan Rengi'),
                                        ColorPicker::make('header_text_color')
                                            ->label('Header Metin Rengi'),
                                        ColorPicker::make('footer_bg_color')
                                            ->label('Footer Arkaplan Rengi'),
                                        ColorPicker::make('footer_text_color')
                                            ->label('Footer Metin Rengi'),
                                        ColorPicker::make('button_primary_bg_color')
                                            ->label('Birincil Buton Arkaplanı'),
                                        ColorPicker::make('button_primary_text_color')
                                            ->label('Birincil Buton Metin Rengi'),
                                        ColorPicker::make('button_secondary_bg_color')
                                            ->label('İkincil Buton Arkaplanı'),
                                        ColorPicker::make('button_secondary_text_color')
                                            ->label('İkincil Buton Metin Rengi'),
                                        ColorPicker::make('header_link_color')
                                            ->label('Header Link Rengi'),
                                        ColorPicker::make('header_link_hover_color')
                                            ->label('Header Link Hover Rengi'),
                                        ColorPicker::make('header_icon_color')
                                            ->label('Header İkon Rengi'),
                                        ColorPicker::make('header_icon_hover_color')
                                            ->label('Header İkon Hover Rengi'),
                                        ColorPicker::make('mobile_menu_bg_color')
                                            ->label('Mobil Menü Arkaplan Rengi'),
                                        ColorPicker::make('mobile_menu_link_color')
                                            ->label('Mobil Menü Link Rengi'),
                                        ColorPicker::make('mobile_menu_link_hover_bg_color')
                                            ->label('Mobil Menü Link Hover Arkaplanı'),
                                        ColorPicker::make('mobile_menu_link_hover_text_color')
                                            ->label('Mobil Menü Link Hover Metin Rengi'),
                                        ColorPicker::make('cart_badge_bg_color')
                                            ->label('Sepet Bildirim Arkaplan Rengi'),
                                        ColorPicker::make('cart_badge_text_color')
                                            ->label('Sepet Bildirim Metin Rengi'),
                                        ColorPicker::make('mobile_menu_button_color')
                                            ->label('Mobil Menü Buton Rengi'),
                                        ColorPicker::make('mobile_menu_button_hover_color')
                                            ->label('Mobil Menü Buton Hover Rengi'),
                                        ColorPicker::make('footer_secondary_text_color')
                                            ->label('Footer İkincil Metin Rengi'),
                                        ColorPicker::make('footer_link_hover_color')
                                            ->label('Footer Link Hover Rengi'),
                                        ColorPicker::make('footer_border_color')
                                            ->label('Footer Çizgi Rengi'),
                                    ])->columns(2),
                            ]),
                    ])
            ])->statePath('data')->columns(1);
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $formData = $this->form->getState();
        $definedSettings = (new GeneralSettings())->getDefaults();
        $payloadToSave = [];

        $fileUploadKeys = [
            'site_logo_header', 
            'site_logo_footer', 
            'hero_background_image', 
            'default_product_image'
        ];

        foreach (array_keys($definedSettings) as $key) {
            if (array_key_exists($key, $formData)) {
                $value = $formData[$key];
                if (in_array($key, $fileUploadKeys)) {
                    $payloadToSave[$key] = is_array($value) ? null : $value;
                } else {
                    $payloadToSave[$key] = $value;
                }
            } else {
                $payloadToSave[$key] = $definedSettings[$key]; 
            }
        }
        
        if (!array_key_exists('maintenance_mode', $payloadToSave)) {
            $payloadToSave['maintenance_mode'] = false;
        }

        $jsonPayload = json_encode($payloadToSave);

        try {
            DB::table('settings')->updateOrInsert(
                ['group' => 'general', 'name' => 'general'],
                [
                    'payload' => $jsonPayload,
                    'locked' => false,
                    'updated_at' => now()
                ]
            );

            Artisan::call('cache:clear');

            Notification::make()
                ->title('Ayarlar Veritabanına Kaydedildi')
                ->success()
                ->send();

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('[ManageSiteSettings] DB Save Exception', [
                'message' => $e->getMessage(), 
                'trace' => $e->getTraceAsString(),
                'payload_attempted' => $payloadToSave
            ]);
            Notification::make()
                ->title('Ayarlar Kaydedilemedi (Veritabanı Hatası)')
                ->danger()
                ->body("Detay: " . $e->getMessage())
                ->persistent()
                ->send();
        }
    }
} 
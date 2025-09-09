<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Spatie');
        $this->migrator->add('general.site_active', true);
        $this->migrator->add('general.logo', 'Spatie');

        $this->migrator->add('general.email', 'info@email.com');
        $this->migrator->add('general.address', 'emarits');
        $this->migrator->add('general.phone', '96658033832');
        $this->migrator->add('general.facebook_link', 'https://www.facebook.com');
        $this->migrator->add('general.google_link', 'https://www.google.com');
        $this->migrator->add('general.instagram_link', 'https://www.instagram.com');
        $this->migrator->add('general.twitter_link', 'https://www.twitter.com');

        $this->migrator->add('general.km_price', '50');
        $this->migrator->add('general.favicon', 'favicon');
        
    }
}


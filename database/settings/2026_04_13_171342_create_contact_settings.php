<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('contact.email', '');
        $this->migrator->add('contact.phone', null);
        $this->migrator->add('contact.telegram', null);
        $this->migrator->add('contact.github_url', null);
        $this->migrator->add('contact.website_url', null);
    }
};

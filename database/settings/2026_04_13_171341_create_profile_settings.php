<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('profile.full_name', '');
        $this->migrator->add('profile.nickname', '');
        $this->migrator->add('profile.job_title', '');
        $this->migrator->add('profile.short_bio', '');
        $this->migrator->add('profile.full_bio', null);
        $this->migrator->add('profile.location', null);
        $this->migrator->add('profile.status', null);
        $this->migrator->add('profile.is_available_for_work', true);
    }
};

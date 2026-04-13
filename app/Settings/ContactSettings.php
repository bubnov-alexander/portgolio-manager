<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ContactSettings extends Settings
{
    public string $email;

    public ?string $phone;

    public ?string $telegram;

    public ?string $github_url;

    public ?string $website_url;

    public static function group(): string
    {
        return 'contact';
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getTelegram(): ?string
    {
        return $this->telegram;
    }

    public function getGithubUrl(): ?string
    {
        return $this->github_url;
    }

    public function getWebsiteUrl(): ?string
    {
        return $this->website_url;
    }
}

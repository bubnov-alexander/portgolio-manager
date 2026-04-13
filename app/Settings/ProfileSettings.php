<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ProfileSettings extends Settings
{
    public string $full_name;

    public string $nickname;

    public string $job_title;

    public string $short_bio;

    public ?string $full_bio;

    public ?string $location;

    public ?string $status;

    public bool $is_available_for_work;

    public static function group(): string
    {
        return 'profile';
    }

    public function getFullName(): string
    {
        return $this->full_name;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function getJobTitle(): string
    {
        return $this->job_title;
    }

    public function getShortBio(): string
    {
        return $this->short_bio;
    }

    public function getFullBio(): ?string
    {
        return $this->full_bio;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function isAvailableForWork(): bool
    {
        return $this->is_available_for_work;
    }
}

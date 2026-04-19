<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Containers\AppSection\Portfolio\Tasks\ListPublishedProjectsTask;
use App\Containers\AppSection\Project\Models\Project;
use App\Containers\AppSection\Technology\Models\Technology;
use App\Settings\ContactSettings;
use App\Settings\ProfileSettings;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Str;

final class BuildHomePageDataTask extends ParentTask
{
    public function __construct(
        private readonly ListPublishedProjectsTask $listPublishedProjectsTask,
    ) {
    }

    public function run(ProfileSettings $profileSettings, ContactSettings $contactSettings): array
    {
        $fullName = $this->normalize($profileSettings->getFullName()) ?? 'Your Name';

        $nicknameValue = $this->normalize($profileSettings->getNickname()) ?? 'nickname';
        $nickname = '@' . ltrim($nicknameValue, '@');
        $nickname = (string) Str::of($nickname)->replaceMatches('/@+/', '@');

        $jobTitle = $this->normalize($profileSettings->getJobTitle()) ?? 'Backend архитектура';
        $shortBio = $this->normalize($profileSettings->getShortBio())
            ?? 'Создаю спокойные и быстрые цифровые продукты с чистой архитектурой.';
        $fullBio = $this->normalize($profileSettings->getFullBio());
        $aboutText = $fullBio ?? $shortBio;

        $email = $this->normalize($contactSettings->getEmail());
        $telegramHandle = $this->normalize($contactSettings->getTelegram());
        $githubUrl = $this->normalizeUrl($contactSettings->getGithubUrl());

        $telegramUrl = null;
        $telegramText = null;

        if ($telegramHandle !== null) {
            $telegramValue = Str::of($telegramHandle)->trim();

            if (Str::startsWith($telegramValue, ['https://', 'http://'])) {
                $telegramUrl = (string) $telegramValue;
                $telegramText = (string) $telegramValue;
            } else {
                $cleanHandle = ltrim((string) $telegramValue, '@');
                if ($cleanHandle !== '') {
                    $telegramUrl = 'https://t.me/' . $cleanHandle;
                    $telegramText = '@' . $cleanHandle;
                }
            }
        }

        $contactUrl = $telegramUrl;
        if ($contactUrl === null && $email !== null) {
            $contactUrl = 'mailto:' . $email;
        }

        $contacts = [
            [
                'label' => 'Email',
                'value' => $email,
                'url' => $email !== null ? 'mailto:' . $email : null,
            ],
            [
                'label' => 'Telegram',
                'value' => $telegramText,
                'url' => $telegramUrl,
            ],
            [
                'label' => 'GitHub',
                'value' => $githubUrl,
                'url' => $githubUrl,
            ],
        ];

        $projects = collect($this->listPublishedProjectsTask->run(3))
            ->take(3)
            ->map(static function (Project $project): array {
                return [
                    'title' => $project->getTitle(),
                    'description' => $project->getShortDescription(),
                    'stack' => $project
                        ->getTechnologies()
                        ->map(static fn (Technology $technology): string => $technology->getName())
                        ->implode(' · '),
                    'slug' => $project->getSlug(),
                ];
            })
            ->all();

        return [
            'profile' => $profileSettings,
            'contact' => $contactSettings,
            'heroName' => $fullName,
            'heroNickname' => $nickname,
            'heroJobTitle' => $jobTitle,
            'heroShortBio' => $shortBio,
            'heroFocus' => $jobTitle,
            'heroApproach' => $shortBio,
            'contactUrl' => $contactUrl,
            'aboutText' => $aboutText,
            'contacts' => $contacts,
            'projects' => $projects,
        ];
    }

    private function normalize(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $trimmed = trim($value);

        return $trimmed !== '' ? $trimmed : null;
    }

    private function normalizeUrl(?string $value): ?string
    {
        $normalized = $this->normalize($value);

        if ($normalized === null) {
            return null;
        }

        if (Str::startsWith($normalized, ['https://', 'http://'])) {
            return $normalized;
        }

        return 'https://' . ltrim($normalized, '/');
    }
}

<?php

namespace App\Containers\AppSection\Project\Models;

use App\Containers\AppSection\Technology\Models\Technology;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'full_description',
        'github_url',
        'preview_url',
        'is_published',
        'sort',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'project_technology');
    }

    public function features(): HasMany
    {
        return $this->hasMany(ProjectFeature::class)->orderBy('sort');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('cover')
            ->useDisk('media')
            ->singleFile();

        $this
            ->addMediaCollection('gallery')
            ->useDisk('media');
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getShortDescription(): string
    {
        return $this->short_description;
    }

    public function getFullDescription(): string|null
    {
        return $this->full_description;
    }

    public function getGithubUrl(): string|null
    {
        return $this->github_url;
    }

    public function getPreviewUrl(): string|null
    {
        return $this->preview_url;
    }

    public function isPublished(): bool
    {
        return $this->is_published;
    }

    public function getSort(): int
    {
        return $this->sort;
    }

    /**
     * @return EloquentCollection<int, Technology>
     */
    public function getTechnologies(): EloquentCollection
    {
        return $this->technologies;
    }

    /**
     * @return EloquentCollection<int, ProjectFeature>
     */
    public function getFeatures(): EloquentCollection
    {
        return $this->features;
    }
}

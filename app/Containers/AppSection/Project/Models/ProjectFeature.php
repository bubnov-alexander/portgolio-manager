<?php

namespace App\Containers\AppSection\Project\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectFeature extends Model
{
    protected $fillable = [
        'project_id',
        'title',
        'sort',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function getProjectId(): int
    {
        return $this->project_id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSort(): int
    {
        return $this->sort;
    }
}

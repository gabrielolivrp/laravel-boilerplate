<?php

namespace App\Models\Traits;

use Ramsey\Uuid\Uuid;

trait HasUuid
{
    /**
     * @param mixed $query
     * @param string $uuid
     * @return mixed
     */
    public function scopeUuid($query, string $uuid): mixed
    {
        return $query->where($this->getUuidName(), $uuid);
    }

    /**
     * @return string
     */
    public function getUuidName(): string
    {
        return $this->uuidName ?? 'uuid';
    }

    /**
     * Use Laravel bootable traits.
     *
     * @return void
     */
    protected static function bootHasUuid(): void
    {
        static::creating(function ($model) {
            $model->{$model->getUuidName()} = Uuid::uuid4()->toString();
        });
    }
}

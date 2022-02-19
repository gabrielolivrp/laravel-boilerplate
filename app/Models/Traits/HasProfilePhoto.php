<?php

namespace App\Models\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasProfilePhoto
{
    /**
     * Update the user's profile photo.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @return void
     */
    public function updateProfilePhoto(UploadedFile $photo): void
    {
        tap($this->profile_photo_path, function ($previous) use ($photo) {
            $this->forceFill([
                'profile_photo_path' => $photo->storePublicly(
                    'profile-photos',
                    $this->disk()
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->disk())->delete($previous);
            }
        });
    }

    /**
     * Delete the user's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto(): void
    {
        Storage::disk($this->disk())->delete($this->profile_photo_path);

        $this->forceFill([
            'profile_photo_path' => null,
        ])->save();
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute(): string
    {
        return $this->profile_photo_path
                    ? Storage::disk($this->disk())->url($this->profile_photo_path)
                    : $this->defaultProfilePhotoUrl();
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl(): string
    {
        $params = http_build_query([
            'name' => urlencode($this->name),
            'color' => config('boilerplate.avatar.color', '7F9CF5'),
            'background' => config('boilerplate.avatar.background', 'EBF4FF'),
            'size' => config('boilerplate.avatar.size', 80),
        ]);

        return 'https://ui-avatars.com/api/?'.$params;
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function disk(): string
    {
        return 'public';
    }
}

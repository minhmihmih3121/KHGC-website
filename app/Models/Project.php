<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PDOException;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const STT_DISABLE = 0;
    const STT_ENABLE = 1;
    const WEBSITE_PLATFORM = 1;
    const MOBILE_PLATFORM = 2;
    const WEBSITE_AND_MOBILE_PLATFORM = 3;

    const PROJECT_IMAGE_COLLECTION = 'project_image';
    const PROJECT_IMAGE_RESIZE_NAME = 'project_image_resize';
    const PROJECT_THUMB_RESIZE_NAME = 'project_thumb_resize';
    const CONVERSION_SIZE = [
        'width' => '650',
        'height' => '415'
    ];
    const THUMB_CONVERSION_SIZE = [
        'width' => '42',
        'height' => '42'
    ];

    protected $fillable = [
        'project_type_id',
        'title',
        'description',
        'link_web',
        'link_app',
        'platform',
        'order',
        'status',
    ];

    protected $casts = [
        'release_date' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];

    protected $with = ['media'];

    //Relationship
    public function projectType(): BelongsTo
    {
        return $this->belongsTo(ProjectType::class);
    }

    //Scope
    public function scopeActive($query)
    {
        return $query->where('status', self::STT_ENABLE);
    }

    public function scopeMobile($query) {
        return $query->where('platform', self::MOBILE_PLATFORM);
    }

    public function scopeWebsite($query) {
        return $query->where('platform', self::WEBSITE_PLATFORM);
    }

    public function scopeWebsiteAndMobile($query) {
        return $query->where('platform', self::WEBSITE_AND_MOBILE_PLATFORM);
    }

    /**
     * Get the item's thumbnail image
     *
     * @param string $value
     * @return bool|string
     */
    public function getImageUrlAttribute($value): bool|string
    {
        if (!$this->relationLoaded('media')) {
            return false;
        }

        $image = $this->getFirstMediaUrl(self::PROJECT_IMAGE_COLLECTION);

        if ($image) {
            return $image;
        }

        return config('app.default_img');
    }

    /**
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion(self::PROJECT_IMAGE_RESIZE_NAME)
            ->fit(Manipulations::FIT_FILL, self::CONVERSION_SIZE['width'], self::CONVERSION_SIZE['height'])
            ->background('fff')
            ->performOnCollections(self::PROJECT_IMAGE_COLLECTION)
            ->sharpen(10)
            ->nonQueued();

        $this->addMediaConversion(self::PROJECT_THUMB_RESIZE_NAME)
            ->fit(Manipulations::FIT_FILL, self::CONVERSION_SIZE['width'], self::CONVERSION_SIZE['height'])
            ->background('fff')
            ->performOnCollections(self::PROJECT_IMAGE_COLLECTION)
            ->sharpen(5)
            ->nonQueued();
    }

    public function getThumbImage() {
        try {
            return $this->getFirstMedia(self::PROJECT_IMAGE_COLLECTION);
        } catch (PDOException $e) {
            return config('app.default_img');
        }
    }

        /**
         * Undocumented function
         *
         * inherit
         *
         * @param [type] $medias
         * @return void
         */
        public function addImage($medias)
        {
            foreach ($medias as $media) {
                $this->addMedia($media);
            }
        }

        public function removeImage($id)
        {
            $this->media()->where('id', $id)->delete();
        }

        public function updateImageUrl($path) {
            $this->image_url = $path;
        }

        public function clearImages() {
            $this->clearMediaCollection(self::PROJECT_IMAGE_COLLECTION);
        }

        
    }

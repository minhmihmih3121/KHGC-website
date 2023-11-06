<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Vite;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Banner extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const STT_DISABLE = 0;
    const STT_ENABLE = 1;

    const BANNER_COLLECTION = 'banner';
    const BANNER_RESIZE_NAME = 'banner_resize';
    const CONVERSION_SIZE = [
        'width' => '650',
        'height' => '415'
    ];

    protected $fillable = [
        'section_id',
        'heading',
        'sub_heading',
        'alt',
        'cover_color',
        'link',
        'views',
        'clicks',
        'status',
        'order'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];
    protected $with = ['media'];

    public function scopeActive($query)
    {
        return $query->where('status', self::STT_ENABLE);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
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

        $image = $this->getFirstMediaUrl(self::BANNER_COLLECTION);

        if ($image) {
            return $image;
        }

        return Vite::asset('resources/images/3.jpeg');
    }

    /**
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion(self::BANNER_RESIZE_NAME)
            ->fit(Manipulations::FIT_FILL, self::CONVERSION_SIZE['width'], self::CONVERSION_SIZE['height'])
            ->background('fff')
            ->performOnCollections(self::BANNER_COLLECTION)
            ->sharpen(10)
            ->nonQueued();
    }
}
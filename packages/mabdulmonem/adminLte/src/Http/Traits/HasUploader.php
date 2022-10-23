<?php

namespace Mabdulmonem\Uploader\Http\Traits;

use App\Models\Utils\Media;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasUploader
{


    /**
     * @return BelongsToMany
     */
    public function media(): BelongsToMany
    {
        return $this->belongsToMany(Media::class, 'product_media', 'model_id', 'media_id')->withPivot('model', 'caption')->withTimestamps();
    }


}

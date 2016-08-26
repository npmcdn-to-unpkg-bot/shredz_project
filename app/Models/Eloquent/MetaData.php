<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Models\Eloquent\Page\Page;

class MetaData extends Model
{
    protected $morphClass = 'MetaData';

    /**
     * table this model is using.
     */
    protected $table = 'metadata';

    /**
     * the fields that can be mass assigned.
     */
    protected $fillable = ['name'];

    /**
     * Get all of the owning imageable models.
     *
     * @return
     */
    public function pages()
    {
        return $this->morphedByMany(Page::class, 'metadatable');
    }

    /**
     * Determine if the metadata has any any models attached.
     *
     * @return bool
     */
    public function hasAttached()
    {
        $pages = $this->pages->toArray();
        if (count($pages)) {
            return true;
        }

        return false;
    }
}

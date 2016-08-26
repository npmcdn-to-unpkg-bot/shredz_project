<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Models\Eloquent\Page\Page;

class Tag extends Model
{
    protected $morphClass = 'Tag';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'key'];

    /**
     * Get all of the owning imageable models.
     *
     * @return
     */
    public function pages()
    {
        return $this->morphedByMany(Page::class, 'tagable');
    }

    /**
     * Determine if the tag has been attached.
     *
     * @return bool
     */
    public function currentlyAttached()
    {
        $pages = $this->pages->toArray();
        if (count($pages)) {
            return true;
        }

        return false;
    }
}

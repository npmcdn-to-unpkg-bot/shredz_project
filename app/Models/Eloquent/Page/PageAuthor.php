<?php

namespace App\Models\Eloquent\Page;

use App\Scopes\PageSortScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eloquent\Asset\Asset;
use App\Models\Eloquent\Asset\AssetRelationType;
use App\Models\Eloquent\Tag;
use App\Models\Eloquent\Page\PageType;
use App\Models\Eloquent\MetaData;
use FitlifeGroup\Models\Eloquent\Channel;
use FitlifeGroup\Models\Eloquent\Store;
use FitlifeGroup\Models\Eloquent\Agent;
use Carbon\Carbon;

class PageAuthor extends Model
{
    protected $table = 'page_authors';

    protected $fillable = [
        'name', 'email'
    ];

    public function pages()
    {
        return $this->hasMany(Page::class, 'page_author_id', 'id');
    }
}
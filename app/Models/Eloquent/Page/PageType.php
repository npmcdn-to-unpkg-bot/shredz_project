<?php
namespace App\Models\Eloquent\Page;

use Illuminate\Database\Eloquent\Model;
use App\Models\Eloquent\Page\Page;
use Carbon\Carbon;

class PageType extends Model
{

    protected $morphClass = 'PageType';

    /**
     * The attributes that are mass assigneable
     */
    protected $fillable = ['name'];

   /**
     * A User can author many pages and they will be assigned to him/her
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function scopePrefixes($query, $path)
    {
        $path = \DB::raw($path);
        $query
        ->whereNotNull('prefix')
        ->where('prefix', '<>', '')
        ->whereRaw('INSTR(\'' . $path . '\', `prefix`) = 1');
    }

}

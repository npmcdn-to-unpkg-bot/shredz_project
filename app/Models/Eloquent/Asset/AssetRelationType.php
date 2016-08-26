<?php
namespace App\Models\Eloquent\Asset;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetRelationType extends Model
{

    protected $morphClass = 'AssetRelationType';

     /**
     * The database table used by the model.
     *
     * @var string
     */
     protected $table = 'asset_relation_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the ID of a relation type by searching it's name
     * @param string $name
     * @return int
     */
    public static function getRelationTypeIdByname($name)
    {
        return static::where('name', $name)->pluck('id');
    }

    /**
     * Determine if current AssetRelationType is being used or applied
     * @return bool
     */
    public function currentlyBeingUsed()
    {
        $data = DB::table('assetables')->lists('relation_type_name');
        return in_array($this->name, $data);
    }
}

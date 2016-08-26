<?php
namespace App\Models\Eloquent\Asset;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GrahamCampbell\Flysystem\Facades\Flysystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Models\Eloquent\Page\Page;


class Asset extends Model
{

    protected $morphClass = 'Asset';
    /**
     * The url where the external link asset will be stored at
     */
    const LINK_ASSET = 'https://player.vimeo.com/video/';

    /**
     * The file path in s3 where the files will be located
     */
    protected $s3Path = 'https://s3.amazonaws.com/dash-assets/assets';

    /**
     * The folder inside the bucket where the images will be stored
     */
    protected $bucketFolder = 'assets';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assets';

    /**
      * The asset's default description
      * @var string
     */
    protected $description = '';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'original_name', 'extension', 'path', 'file_size', 'hash_name'];

    /**
     * The file the asset will be using.
     *
     * @var string
     */
    public $file;

    /**
     * The directory where all photos will be stored
     *
     * @var string
     */
    protected $baseDir = 'assets';

    /**
     * Constructor of the Asset class
     *
     * @access public
     */
    public function __construct()
    {
        $this->baseDir = storage_path($this->baseDir);
    }

    /**
     * Get all of the owning assetable models.
     * @return
     */
    public function products()
    {
        return $this->morphedByMany('Product', 'assetable');
    }

    /**
     * Get all of the owning assetable models.
     * @return
     */
    public function productVariants()
    {
        return $this->morphedByMany('ProductVariant', 'assetable');
    }

    /**
     * Get all of the owning assetable models.
     * @return
     */
    public function stores()
    {
        return $this->morphedByMany('Store', 'assetable');
    }

    /**
     * Get all of the owning assetable models.
     * @return
     */
    public function pages()
    {
        return $this->morphedByMany(Page::class, 'assetable');
    }

    /**
     * Named constructor
     *
     * @param Symfony\Component\HttpFoundation\File\UploadedFile*
     * @param array $data
     * @return static
     */
    public static function fromFile(UploadedFile $file, $data)
    {
        $asset = new static;
        $asset->file = $file;
        $asset->fill([
            'name' => $asset->name($data['name']),
            'description' => $asset->description($data['description']),
            'original_name' => $asset->file->getClientOriginalName(),
            'extension' => $asset->file->getClientOriginalExtension(),
            'path'  => $asset->filePath(),
            'hash_name' => $asset->fileName()
        ]);
        return $asset;
    }

    /**
     * Find asset by id remove the old from s3, attach the newone and upload
     * @param int $id
     * @param Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @param array $data
     * @return static
     */
    public static function fromFileById($id, UploadedFile $file, $data)
    {
        $asset = static::find($id);
        $asset->deleteFromCloud();
        $asset->file = $file;
        $asset->fill([
            'name' => $asset->name($data['name']),
            'description' => $asset->description($data['description']),
            'original_name' => $asset->file->getClientOriginalName(),
            'extension' => $asset->file->getClientOriginalExtension(),
            'path'  => $asset->filePath()
        ]);
        $asset->hash_name = $asset->fileName();
        return $asset;
    }

    /**
     * Description of the asset
     * @param string $desciption
     * @return string
     */
    public function description($description)
    {
        return $description ? $description : $this->description;
    }

    /**
     * The new file name
     *
     * @return string
     */
    public function fileName()
    {
        $name = sha1($this->file->getClientOriginalName());
        $extension = $this->file->getClientOriginalExtension();
        return "{$name}.{$extension}";
    }

    /**
     * Set the name of file
     * @param sring $name
     * @return string
     *
     */
    public function name($name)
    {
        return $name ? $name : preg_replace('/\\.[^.\\s]{3,4}$/', '', $this->file->getClientOriginalName());
    }

    /**
     * The path where the file will be located
     *
     * @return string
     */
    public function filePath()
    {
        return $this->baseDir. '/' . $this->fileName();
    }

    /**
     * Remove from cloud
     * @return void
     */
    public function deleteFromCloud()
    {
        Flysystem::delete('/'.$this->bucketFolder.'/'.$this->hash_name);
    }

    /**
     * Delete file from local directory
     * @return void
     */
    public function deleteFromLocal()
    {
        File::delete($this->path);
    }

     /**
     * Upload to cloud like s3
     *
     * @return static
     */
    public function upload()
    {
        $this->file->move( $this->baseDir, $this->fileName());
        $uploaded = Flysystem::write('/'.$this->bucketFolder.'/'.$this->fileName(), file_get_contents($this->baseDir.'/'.$this->fileName()), ['visibility' => 'public']);

        if(!$uploaded){
            $this->deleteFromLocal();
            throw new Exception('Image could not be uploaded. Please try again later.');
        }
        $this->deleteFromLocal();
        $this->path = $this->s3Path.'/'.$this->fileName();
        $this->file_size = Flysystem::getSize('/'.$this->bucketFolder.'/'.$this->fileName());
        return $this;
    }

    /**
     * check if the asset is an external link
     */
    public static function isExternalLink($path)
    {
        // Regular Expression for breaking down the URL
        $re = '/^(((http|https):)?\\/\\/)?((([a-z0-9][a-z0-9\\-]*[a-z0-9])\\.)?(([a-z0-9][a-z0-9\\-]*[a-z0-9])\\.([a-z]{2,}\\.)*([a-z]{2,})))(\\/.*)?$/i';
        if (preg_match($re, $path, $m)) {
             if(empty($m[6])){
                $path = $m[1].$m[7];
            }else{
                $path = $m[1].$m[6].'.'.$m[7];
            }
            $assetPath = $path .'/video/';
            if(static::LINK_ASSET == $assetPath){
                return true;
            }else{
                return false;
            }

        }
    }


    /**
     * Determine whether the asset is a video
     * @return bool
     */
    public function isVideo()
    {
        $extensions = ['mp4'];
        return in_array($this->extension, $extensions);
    }

    /**
     * Determine whether the asset is an image file
     * @return bool
     */
    public function isImage()
    {
        $extensions = ['jpg','jpeg','png','bmp'];
        return in_array($this->extension, $extensions);
    }

    /**
     * Determine whether the asset is an html file
     * @return bool
     */
    public function isHtml()
    {
        $extensions = ['html'];
        return in_array($this->extension, $extensions);
    }

    /**
     * Determine whether the asset is a pdf file
     * @return bool
     */
    public function isPdf()
    {
        $extensions = ['pdf'];
        return in_array($this->extension, $extensions);
    }

    /**
     * Determine if current asset has been attached to another model
     * @return bool
     */
    public function currentlyAttached()
    {
        $products = $this->products->toArray();
        $variants = $this->productVariants->toArray();
        $stores = $this->stores->toArray();
        $pages = $this->pages->toArray();

        if(count(array_merge($products, $variants, $stores, $pages))){
            return true;
        }
        return false;
    }



}

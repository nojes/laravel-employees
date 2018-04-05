<?php

namespace nojes\employees\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Kalnoy\Nestedset\NodeTrait;

/**
 * Employee model.
 *
 * @property integer id
 * @property integer _lft
 * @property integer _rgt
 * @property integer parent_id
 * @property integer position_id
 * @property string name
 * @property integer salary
 * @property int hired_at
 * @property string photo
 * @property string photoUrl
 * @property int created_at
 * @property int updated_at
 *
 * @property Employee head
 * @property Position position
 * @property Employee[] children
 *
 */
class Employee extends Model
{
    use NodeTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'position_id', 'name', 'salary', 'hired_at', 'photo'];

    /**
     * Returns parent node.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function head()
    {
        return $this->belongsTo('nojes\employees\Models\Employee', 'parent_id')->withDefault();
    }

    /**
     * Returns Position.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position()
	{
		return $this->belongsTo('nojes\employees\Models\Position', 'position_id')->withDefault();
	}

    /**
     * Returns photo url.
     *
     * @return string
     */
    public function getPhotoUrlAttribute()
    {
        $photo = $this->photo;
        if (!empty($photo)) {
            $photo = (starts_with($photo, 'https')) ? $photo : Storage::url($photo);
        } else {
            $photo = Storage::url('public/employees/default_photo.jpg');
	    }

	    return $photo;
    }
}

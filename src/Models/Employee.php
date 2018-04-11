<?php

namespace nojes\employees\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
 * @method \Illuminate\Database\Eloquent\Builder whereIsRoot()
 */
class Employee extends Model
{
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
        return $this->belongsTo(get_class($this), 'parent_id')->withDefault();
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
     * Returns Employee children.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(get_class($this), 'parent_id')->orderBy('_lft');
    }

    /**
     * Returns root nodes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereIsRoot($query)
    {
        return $query->whereNull('parent_id');
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

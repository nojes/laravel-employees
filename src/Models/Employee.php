<?php

namespace nojes\employees\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * Employee model.
 *
 * @property string name
 * @property integer head_id
 * @property integer salary
 * @property int hired_at
 * @property string photo
 *
 * @property Employee head
 * @property Position position
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
    protected $fillable = ['head_id', 'position_id', 'name', 'salary', 'hired_at', 'photo'];

    public function head()
    {
        return $this->belongsTo('nojes\employees\Models\Employee', 'head_id')->withDefault();
    }

    public function position()
	{
		return $this->belongsTo('nojes\employees\Models\Position', 'position_id')->withDefault();
	}
}

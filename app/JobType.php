<?php

namespace App;

use App;
use App\Traits\Lang;
use App\Traits\IsDefault;
use App\Traits\Active;
use App\Traits\Sorted;
use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{

    use Lang;
    use IsDefault;
    use Active;
    use Sorted;

    protected $table = 'job_types';
    public $timestamps = true;
    protected $guarded = ['id'];
    //protected $dateFormat = 'U';
    protected $dates = ['created_at', 'updated_at'];


    public static function getJobTypes($limit = 10)
    {
        return self::where('is_active','=',1)->lang()->paginate($limit);
    }

    public static function getJobTypesForFooter($limit = 10)
    {
        return self::where('is_active','=',1)->lang()->take($limit)->get();
    }

}

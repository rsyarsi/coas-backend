<?php

namespace Src\V2\Hospitals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class HospitalModel extends Model
{
    use HasUuids;

    /**
     * @var string
     */
    protected $table = "hospitals";

    /**
     * @var string
     */
    protected $primaryKey = "id";

    /**
     * @var array
     */
    protected $fillable = [ "name", ];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope("activation", function (Builder $builder) {

            $builder->where("active", 1);
        });
    }

    /**
     * @return void
     */
    public function activate()
    {
        $this->active = 1;
        $this->save();
    }

    /**
     * @return void
     */
    public function deactivate()
    {
        $this->active = 0;
        $this->save();
    }
};

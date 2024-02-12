<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emrpedodontie_behaviorrating extends Model
{
    use HasFactory;
    protected $table = "emrpedodontie_behaviorratings";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'noregister',
        'noepisode',
        'physicalgrowth',
        'heartdesease',
        'bruiseeasily',
        'anemia',
        'hepatitis',
        'allergic',
        'takinganymedicine',
        'beenhospitalized',
        'toothache',
        'childtoothache',
        'firstdental',
        'unfavorabledentalexperience',
        'ifyes',
        'where',
        'reason',
        'fingersucking',
        'diffycultyopeningsjaw',
        'howoftenbrushtooth',
        'usefluoridepasta',
        'fluoridetreatmen',
        'bilateralsymmetry',
        'asymmetry',
        'straight',
        'convex',
        'concave',
        'lipsseal',
        'clicking',
        'clickingleft',
        'clickingright',
        'pain',
        'painleft',
        'painright',
        'bodypostur',
        'stageofdentition',
        'gingivitis',
        'stomatitis',
        'gumboil',
        'dentalanomali',
        'prematurloss',
        'overretainedprimarytooth'
    ];
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Stats
 *
 * @property int $id
 * @property int $link_id
 * @property string $country
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Link $link
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stats whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stats whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stats whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stats whereLinkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stats whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Stats extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stats';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'link_id', 'country'
    ];

    /**
     * Get the link that owns the stats.
     */
    public function link()
    {
        return $this->belongsTo('App\Link');
    }
}

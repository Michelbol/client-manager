<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Client
 *
 * @property int $id
 * @property string $name
 * @property Carbon $date_of_birth
 * @property string $gender
 * @property string|null $zip_code
 * @property string|null $address
 * @property string|null $number
 * @property string|null $complement
 * @property string|null $neighborhood
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $city_id
 * @property-read City|null $city
 * @method static Builder|Client newModelQuery()
 * @method static Builder|Client newQuery()
 * @method static Builder|Client query()
 * @method static Builder|Client whereAddress($value)
 * @method static Builder|Client whereCityId($value)
 * @method static Builder|Client whereComplement($value)
 * @method static Builder|Client whereCreatedAt($value)
 * @method static Builder|Client whereDateOfBirth($value)
 * @method static Builder|Client whereGender($value)
 * @method static Builder|Client whereId($value)
 * @method static Builder|Client whereName($value)
 * @method static Builder|Client whereNeighborhood($value)
 * @method static Builder|Client whereNumber($value)
 * @method static Builder|Client whereUpdatedAt($value)
 * @method static Builder|Client whereZipCode($value)
 * @mixin Eloquent
 */
class Client extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'date_of_birth',
        'gender',
        'zip_code',
        'address',
        'number',
        'complement',
        'neighborhood',
        'city_id',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'city_id' => 'int',
        'date_of_birth' => 'date',
    ];

    /**
     * @return BelongsTo
     */
    public function city() : BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @param $value
     */
    public function setZipCodeAttribute($value)
    {
        $this->attributes['zip_code'] = isset($value) ? returnOnlyNumbers($value) : $value;
    }
}

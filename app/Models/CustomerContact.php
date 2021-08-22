<?php

namespace App\Models;

use App\Traits\ConvertTimezone;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;
use Propaganistas\LaravelPhone\PhoneNumber;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\CustomerContact
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $customer_id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $title
 * @property string $phone
 * @property string|null $extension
 * @property string|null $email
 * @property Carbon|null $deleted_at
 * @property int $order_column
 * @property-read Collection|Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read Customer $customer
 * @method static Builder|CustomerContact newModelQuery()
 * @method static Builder|CustomerContact newQuery()
 * @method static Builder|CustomerContact onlyTrashed()
 * @method static Builder|CustomerContact query()
 * @method static Builder|CustomerContact whereCreatedAt($value)
 * @method static Builder|CustomerContact whereCustomerId($value)
 * @method static Builder|CustomerContact whereDeletedAt($value)
 * @method static Builder|CustomerContact whereEmail($value)
 * @method static Builder|CustomerContact whereExtension($value)
 * @method static Builder|CustomerContact whereFirstName($value)
 * @method static Builder|CustomerContact whereId($value)
 * @method static Builder|CustomerContact whereLastName($value)
 * @method static Builder|CustomerContact whereOrderColumn($value)
 * @method static Builder|CustomerContact wherePhone($value)
 * @method static Builder|CustomerContact whereTitle($value)
 * @method static Builder|CustomerContact whereUpdatedAt($value)
 * @method static Builder|CustomerContact withTrashed()
 * @method static Builder|CustomerContact withoutTrashed()
 * @mixin \Eloquent
 */
class CustomerContact extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ConvertTimezone;
    use LogsActivity;

    protected $fillable = [
        'customer_id',
        'first_name',
        'last_name',
        'title',
        'phone',
        'extension',
        'email',
    ];

    protected $casts = [
        'phone' => E164PhoneNumberCast::class.':US',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function getPhoneAttribute($attribute): string
    {
        if ($attribute === null) {
            return '';
        }
        return PhoneNumber::make($attribute, 'US')->formatNational();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->logOnlyDirty();
    }

}

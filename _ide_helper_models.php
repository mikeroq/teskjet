<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Brand
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string|null $website
 * @property string|null $support_number
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereSupportNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereWebsite($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Device[] $devices
 * @property-read int|null $devices_count
 */
	class Brand extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ConnectedAccount
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider
 * @property string $provider_id
 * @property string|null $name
 * @property string|null $nickname
 * @property string|null $email
 * @property string|null $telephone
 * @property string|null $avatar_path
 * @property string $token
 * @property string|null $secret
 * @property string|null $refresh_token
 * @property string|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereAvatarPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereUserId($value)
 */
	class ConnectedAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * Customer
 *
 * @mixin Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $phone
 * @property string $type
 * @property bool $taxable
 * @property-read mixed $displayable_taxable
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTaxable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Device[] $devices
 * @property-read int|null $devices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CustomerLocation[] $locations
 * @property-read int|null $locations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read int|null $revision_history_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ticket[] $tickets
 * @property-read int|null $tickets_count
 * @method static \Illuminate\Database\Query\Builder|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Customer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Customer withoutTrashed()
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CustomerLocation
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $customer_id
 * @property string $name
 * @property string $address
 * @property string $address_2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $phone
 * @property-read \App\Models\Customer $customer
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereZip($value)
 */
	class CustomerLocation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Device
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $brand_id
 * @property int $device_type_id
 * @property int $customer_id
 * @property string $model
 * @property string|null $serial_number
 * @property string $notes
 * @method static \Illuminate\Database\Eloquent\Builder|Device newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device query()
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereDeviceTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Brand $brand
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\DeviceType $deviceType
 */
	class Device extends \Eloquent {}
}

namespace App\Models{
/**
 * App\DeviceType
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Device[] $devices
 * @property-read int|null $devices_count
 */
	class DeviceType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Navigation
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $parent_id
 * @property string $title
 * @property string $icon
 * @property string|null $url
 * @property string $route
 * @property int $user_level
 * @property int $order_id
 * @property-read Navigation $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|Navigation[] $subcategories
 * @property-read int|null $subcategories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereUserLevel($value)
 * @mixin \Eloquent
 * @property int $navigation_type_id
 * @property int $order_column
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\NavigationChild[] $children
 * @property-read int|null $children_count
 * @property-read mixed $level
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereNavigationTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereOrderColumn($value)
 */
	class Navigation extends \Eloquent implements \Spatie\EloquentSortable\Sortable {}
}

namespace App\Models{
/**
 * App\Models\NavigationChild
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $navigation_id
 * @property string $title
 * @property string|null $url
 * @property \App\Enums\UserType $user_level
 * @property int $order_column
 * @property-read mixed $level
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Navigation $parent
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationChild newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationChild newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationChild ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationChild query()
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationChild whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationChild whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationChild whereNavigationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationChild whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationChild whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationChild whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationChild whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationChild whereUserLevel($value)
 */
	class NavigationChild extends \Eloquent implements \Spatie\EloquentSortable\Sortable {}
}

namespace App\Models{
/**
 * App\Models\NavigationType
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $slug
 * @property int $children
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Navigation[] $navigations
 * @property-read int|null $navigations_count
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationType query()
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationType whereChildren($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationType whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationType whereUpdatedAt($value)
 */
	class NavigationType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Ticket
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read int|null $revision_history_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|Ticket onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Ticket withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Ticket withoutTrashed()
 */
	class Ticket extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property int $two_factor_confirmed
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property int|null $current_connected_account_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Enums\UserType $user_level
 * @property string|null $timezone
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ConnectedAccount[] $connectedAccounts
 * @property-read int|null $connected_accounts_count
 * @property-read \App\Models\ConnectedAccount|null $currentConnectedAccount
 * @property-read string|bool $is_two_factor_enabled
 * @property-read mixed $level
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentConnectedAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserLevel($value)
 */
	class User extends \Eloquent {}
}


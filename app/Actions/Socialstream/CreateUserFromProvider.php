<?php

/** @noinspection DuplicatedCode */

/** @noinspection ReturnTypeCanBeDeclaredInspection */

/** @noinspection PhpMissingReturnTypeInspection */

/** @noinspection PhpUnhandledExceptionInspection */

namespace App\Actions\Socialstream;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use JoelButcher\Socialstream\Contracts\CreatesConnectedAccounts;
use JoelButcher\Socialstream\Contracts\CreatesUserFromProvider;
use JoelButcher\Socialstream\Socialstream;
use Laravel\Jetstream\Jetstream;
use Laravel\Socialite\Contracts\User as ProviderUser;

class CreateUserFromProvider implements CreatesUserFromProvider
{
    public CreatesConnectedAccounts $createsConnectedAccounts;

    public function __construct(CreatesConnectedAccounts $createsConnectedAccounts)
    {
        $this->createsConnectedAccounts = $createsConnectedAccounts;
    }

    public function create(string $provider, ProviderUser $providerUser)
    {
        return DB::transaction(fn () => tap(User::create([
            'name' => $providerUser->getName() ?? $providerUser->getNickname(),
            'email' => $providerUser->getEmail(),
        ]), function (User $user) use ($provider, $providerUser) {
            $user->markEmailAsVerified();

            if (Socialstream::hasProviderAvatarsFeature() && Jetstream::managesProfilePhotos() && $providerUser->getAvatar()) {
                $user->setProfilePhotoFromUrl($providerUser->getAvatar());
            }

            $user->switchConnectedAccount(
                $this->createsConnectedAccounts->create($user, $provider, $providerUser)
            );
        }));
    }
}

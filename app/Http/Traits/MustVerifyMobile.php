<?php

namespace App\Http\Traits;

use App\Notifications\SendVerifySMS;

trait MustVerifyMobile
{
    public function hasVerifiedMobile() : bool
    {
        return ! is_null($this->mobile_verified_at);
    }

    public function markMobileHasVerified() : bool
    {
        return $this->forceFill([
            'mobile_verified_at' => $this->freshTimestamp()
        ])->save();
    }

    public function sendMobileVerificationNotification() : void
    {
        $this->notify(new SendVerifySMS);
    }
}
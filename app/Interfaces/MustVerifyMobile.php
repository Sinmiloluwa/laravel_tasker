<?php

namespace App\Interfaces;

interface MustVerifyMobile
{
    public function hasVerifiedMobile();

    public function markMobileHasVerified();

    public function sendMobileVerificationNotification();
}
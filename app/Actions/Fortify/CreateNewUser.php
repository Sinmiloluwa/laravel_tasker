<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : ''
        ])->validate();

        $verificationCode = random_int(11111, 99999);

        $basic  = new \Vonage\Client\Credentials\Basic(env('VONAGE_API'), env('VONAGE_API_SECRET'));
        $client = new \Vonage\Client($basic);

        $client->message()->send([
            'to' => '+234 808 045 5426',
            'from' => 'Taskert',
            'text' => 'Welcome to Taskert. Your verification code is '. $verificationCode 
        ]);

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'phone' => '+234 808 045 5426',
            'otp' => $verificationCode
        ]);
    }
}

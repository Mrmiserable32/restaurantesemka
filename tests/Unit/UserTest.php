<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_only_expected_attributes_are_mass_assignable(): void
    {
        $user = new User([
            'name' => 'Royyan',
            'email' => 'royyan@example.com',
            'password' => 'secret',
            'remember_token' => 'should-be-ignored',
        ]);

        $this->assertSame('Royyan', $user->name);
        $this->assertSame('royyan@example.com', $user->email);
        $this->assertNull($user->remember_token);
    }

    public function test_password_and_remember_token_are_hidden_from_serialization(): void
    {
        $user = new User([
            'name' => 'Royyan',
            'email' => 'royyan@example.com',
            'password' => 'secret',
        ]);
        $user->remember_token = 'token';

        $this->assertArrayNotHasKey('password', $user->toArray());
        $this->assertArrayNotHasKey('remember_token', $user->toArray());
        $this->assertArrayHasKey('email', $user->toArray());
    }

    public function test_password_is_hashed_and_email_verified_at_is_cast_to_datetime(): void
    {
        $user = new User(['password' => 'secret']);
        $user->email_verified_at = '2026-02-24 07:52:50';

        $this->assertNotSame('secret', $user->getAttributes()['password']);
        $this->assertTrue(Hash::check('secret', $user->getAttributes()['password']));
        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $user->email_verified_at);
    }

    public function test_factory_builds_a_verified_user_and_unverified_state(): void
    {
        $user = User::factory()->make();
        $unverified = User::factory()->unverified()->make();

        $this->assertNotEmpty($user->name);
        $this->assertNotEmpty($user->email);
        $this->assertNotNull($user->email_verified_at);
        $this->assertNull($unverified->email_verified_at);
    }
}

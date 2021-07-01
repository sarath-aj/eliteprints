<?php

namespace Tests\Unit\Products;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordHistoryTest extends TestCase
{
    /** @test */
    public function it_saves_password_to_password_history_table_when_user_creating()
    {
        $user = factory(User::class)->create([
            'password' => 'secret'
        ]);
        $this->assertTrue(Hash::check('secret', $user->passwordHistory()->first()->password));
    }
}

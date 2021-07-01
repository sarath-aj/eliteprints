<?php

namespace Tests\Unit\Products;

use App\Models\Address;
use App\Models\Country;
use App\Models\User;
use Tests\TestCase;

class AddressTest extends TestCase
{
    /** @test */
    public function it_belongs_to_a_country()
    {
        $address = factory(Address::class)->create([
            'user_id' => 2
        ]);

        $this->assertInstanceOf(Country::class, $address->country);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $address = factory(Address::class)->create([
            'user_id' => 2
        ]);

        $this->assertInstanceOf(User::class, $address->user);
    }

    /** @test */
    public function it_sets_old_addresses_to_not_default_when_creating()
    {
        $user = factory(User::class)->create();

        $oldAddress = factory(Address::class)->create([
            'is_default' => true,
            'user_id' => $user->id,
        ]);

        factory(Address::class)->create([
            'is_default' => true,
            'user_id' => $user->id,
        ]);
        // fresh() -- freshly get out of the database
        $this->assertFalse($oldAddress->fresh()->default);
    }
}

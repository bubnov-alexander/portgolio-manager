<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Seeders;

use App\Containers\AppSection\Authorization\Data\Seeders\SuperAdminSeeder_2;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(SuperAdminSeeder_2::class)]
final class SuperAdminSeederTest extends UnitTestCase
{
    public function testSeedsSuperAdmin(): void
    {
        $this->assertDatabaseCount('users', 1);
        $user = User::first();
        $this->assertSame(config('seeders.super_admin.email'), $user->email);
        $this->assertSame(config('seeders.super_admin.name'), $user->name);
        $this->assertTrue(Hash::check(config('seeders.super_admin.password'), $user->password));
    }
}

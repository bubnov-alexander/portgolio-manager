<?php

namespace App\Containers\AppSection\User\Tests\Unit\Actions;

use App\Containers\AppSection\User\Actions\UpdateUserAction;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(UpdateUserAction::class)]
final class UpdateUserActionTest extends UnitTestCase
{
    public function testCanUpdateUser(): void
    {
        $user = User::factory()->createOne(['password' => 'youShallNotPass']);
        $data = [
            'name' => 'a name',
            'password' => 'test',
        ];
        $action = app(UpdateUserAction::class);

        $result = $action->run($user->id, $data);

        $this->assertSame($data['name'], $result->name);
        $this->assertTrue(Hash::check($data['password'], $result->password));
    }
}

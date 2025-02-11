<?php

namespace Tests\Unit\app\Models;

use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    #[Test]
    public function it_has_fillable_fields(): void
    {
        $user = new User();

        $this->assertEquals(
            [
                'name',
                'email',
                'password',
            ],
            $user->getFillable()
        );
    }

    #[Test]
    public function it_has_hidden_fields(): void
    {
        $user = new User();

        $this->assertEquals(
            [
                'password',
                'remember_token',
            ],
            $user->getHidden()
        );
    }

    #[Test]
    public function it_has_casts(): void
    {
        $user = new User();

        $this->assertEquals(
            [
                'email_verified_at' => 'datetime',
                'password' => 'hashed',
                'id' => 'int',
            ],
            $user->getCasts()
        );
    }
}

<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Modules\Administrator\Models\Administrator;

uses(
    RefreshDatabase::class,
);

it('should update my password', function () {
    /** @var \Tests\TestCase $this */
    $administrator = Administrator::factory()
        ->create();

    $oldPassword = $administrator->password;
    Sanctum::actingAs(user: $administrator, guard: 'administrator');

    $response = $this->putJson(
        uri: route(
            name: 'api.mng.my.password.update',
            parameters: [],
        ),
        data: [
            'password' => '123123123',
        ],
    );

    $response->assertNoContent();
    $this->assertNotEquals(
        expected: $oldPassword,
        actual: $administrator->fresh()->password,
    );
});

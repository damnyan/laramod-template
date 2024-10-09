<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Modules\Administrator\Models\Administrator;
use Spatie\Permission\Models\Role;

uses(
    RefreshDatabase::class,
);

beforeEach(function () {
    $this->artisan(command: 'app:install');
    Sanctum::actingAs(user: Administrator::first(), guard: 'administrator');
});

it('should sync roles', function () {
    /** @var \Tests\TestCase $this */
    $administrator = Administrator::factory()->create();
    $role = Role::create([
        'name' => 'asdfasdf',
        'guard_name' => 'administrator'
    ]);

    $response = $this->putJson(
        uri: route(
            name: 'api.mng.administrator.role.sync',
            parameters: [
                'administrator' => $administrator,
            ],
        ),
        data: [
            'roles' => [$role->name]
        ],
    );

    $response->assertNoContent();
    $this->assertEquals(
        expected: $role->id,
        actual: $administrator->fresh()->roles->first()->id,
    );
});

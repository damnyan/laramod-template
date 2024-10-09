<?php

namespace Modules\ACL\Tests\Feature\Mng;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Modules\ACL\Enums\AdministratorPermission;
use Modules\Administrator\Models\Administrator;
use Spatie\Permission\Models\Role;

uses(
    RefreshDatabase::class,
);

beforeEach(function () {
    $this->artisan(command: 'app:install');
    Sanctum::actingAs(user: Administrator::first(), guard: 'administrator');
});

it('should list', function () {
    /** @var \Tests\TestCase $this */
    $response = $this->getJson(
        uri: route(
            name: 'api.mng.acl.role.index',
        ),
    );

    $response->assertOk();
});

it('should store', function () {
    /** @var \Tests\TestCase $this */
    $response = $this->postJson(
        uri: route(
            name: 'api.mng.acl.role.store',
        ),
        data: [
            'name' => 'Name',
            'permissions' => AdministratorPermission::toArray(),
        ]
    );

    $response->assertCreated();
    $this->assertTrue(Role::exists($response->json(key: 'data.id')));
});

it('should show', function () {
    /** @var \Tests\TestCase $this */
    $response = $this->getJson(
        uri: route(
            name: 'api.mng.acl.role.show',
            parameters: ['role' => Role::first()],
        ),
    );

    $response->assertOk();
});

it('should update', function () {
    /** @var \Tests\TestCase $this */
    $role = Role::create(['name' => 'old name', 'guard_name' => 'administrator']);
    $newName = 'new name';
    $response = $this->putJson(
        uri: route(
            name: 'api.mng.acl.role.update',
            parameters: ['role' => $role],
        ),
        data: [
            'name' => $newName,
            'permissions' => AdministratorPermission::toArray(),
        ]
    );

    $response->assertOk();
    $this->assertEquals(
        expected: $newName,
        actual: $role->fresh()->name
    );
});

it('should destroy', function () {
    /** @var \Tests\TestCase $this */
    $role = Role::create(['name' => 'old name', 'guard_name' => 'administrator']);
    $response = $this->deleteJson(
        uri: route(
            name: 'api.mng.acl.role.destroy',
            parameters: ['role' => $role],
        ),
    );

    $response->assertNoContent();
    $this->assertNull($role->fresh());
});

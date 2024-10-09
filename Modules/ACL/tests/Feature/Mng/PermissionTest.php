<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Modules\Administrator\Models\Administrator;

uses(
    RefreshDatabase::class,
);

beforeEach(function () {
    $this->artisan(command: 'app:install');
    Sanctum::actingAs(user: Administrator::first(), guard: 'administrator');
});

it('should list permissions', function () {
    $response = $this->getJson(
        uri: route(
            name: 'api.mng.acl.permission.index',
        ),
    );

    $response->assertOk();
});

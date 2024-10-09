<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Modules\Administrator\Models\Administrator;
use Modules\File\Tests\Helpers\FakeFile;
use Spatie\Permission\Models\Role;

uses(
    RefreshDatabase::class,
);

beforeEach(function () {
    $this->artisan(command: 'app:install');
    Sanctum::actingAs(user: Administrator::first(), guard: 'administrator');
});

it('should list', function() {
    /** @var \Tests\TestCase $this */
    Administrator::factory()
        ->count(count: 2)
        ->create();

    $response = $this->getJson(
        uri: route(
            name: 'api.mng.administrator.index',
            parameters: [
                'per_page' => 10001
            ]
        )
    );

    $response->assertOk();
});

it('should store', function() {
    /** @var \Tests\TestCase $this */
    FakeFile::fakeStorages();
    $faceUrl = FakeFile::tmpImage();

    $response = $this->postJson(
        uri: route(
            name: 'api.mng.administrator.store',
        ),
        data: [
            'face_url' => $faceUrl,
            'email' => fake()->email,
            'password' => '123123123',
            'first_name' => fake()->firstName,
            'middle_name' => fake()->lastName,
            'last_name' => fake()->lastName,
            'suffix' => fake()->suffix,
            'roles' => [
                Role::first()->name,
            ]
        ]
    );

    $response->assertCreated();
});

it('should show', function() {
    /** @var \Tests\TestCase $this */
    $administrator = Administrator::factory()
        ->create();
    $response = $this->getJson(
        uri: route(
            name: 'api.mng.administrator.show',
            parameters: [
                'administrator' => $administrator,
            ]
        ),
    );

    $response->assertOk();
});

it('should update', function () {
    /** @var \Tests\TestCase $this */
    $administrator = Administrator::factory()
        ->create();

    $response = $this->putJson(
        uri: route(
            name: 'api.mng.administrator.update',
            parameters: [
                'administrator' => $administrator,
            ]
        ),
        data: [
            'email' => fake()->email,
            'first_name' => fake()->firstName,
            'middle_name' => fake()->lastName,
            'last_name' => fake()->lastName,
            'suffix' => fake()->suffix,
            'roles' => [
                Role::first()->name,
            ],
        ]
    );

    $response->assertOk();
});

it('should destroy', function () {
    /** @var \Tests\TestCase $this */
    $administrator = Administrator::factory()
        ->create();

    $response = $this->deleteJson(
        uri: route(
            name: 'api.mng.administrator.destroy',
            parameters: [
                'administrator' => $administrator,
            ]
        ),
    );

    $response->assertNoContent();
    $this->assertNull($administrator->fresh());
});

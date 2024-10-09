<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Modules\Administrator\Models\Administrator;
use Modules\Client\Models\Client;
use Modules\File\Tests\Helpers\FakeFile;

uses(
    RefreshDatabase::class,
);

beforeEach(function () {
    $administrator = Administrator::factory()
        ->create();

    Sanctum::actingAs(user: $administrator, guard: 'administrator');
});


it('should show my profile', function () {
    /** @var \Tests\TestCase $this */
    $response = $this->getJson(
        uri: route(
            name: 'api.mng.my.profile.show',
            parameters: [],
        ),
    );

    $response->assertOk();
});

it('should update my profile', function () {
    /** @var \Tests\TestCase $this */
    $payload = [
        'face_url' => FakeFile::tmpImage(),
        'first_name' => fake()->firstName,
        'middle_name' => fake()->lastName,
        'last_name' => fake()->lastName,
        'suffix' => fake()->suffix,
    ];

    $response = $this->putJson(
        uri: route(
            name: 'api.mng.my.profile.update',
            parameters: [],
        ),
        data: $payload,
    );

    $response->assertOk();
});

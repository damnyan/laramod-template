<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Modules\Administrator\Models\Administrator;

uses(
    RefreshDatabase::class,
);

beforeEach(function () {
    $this->artisan('app:install');
});

it('should handle invalid credentials', function () {
    /** @var \Tests\TestCase $this */
    $response = $this->postJson(
        uri: route(
            name: 'api.mng.auth.login',
        ),
        data: [
            'email' => 'asdf@asdf.com',
            'password' => 'asdfasdfasdf',
        ],
    );

    $response->assertUnauthorized();
});

it('should get token on valid credentials', function () {
    /** @var \Tests\TestCase $this */
    $password = '123123123';
    $administrator = Administrator::factory()
        ->create([
            'password' => $password,
        ]);

    $response = $this->postJson(
        uri: route(
            name: 'api.mng.auth.login',
        ),
        data: [
            'email' => $administrator->email,
            'password' => $password,
        ],
    );

    $response->assertOk();
    $this->assertInstanceOf(
        expected: PersonalAccessToken::class,
        actual: $administrator->tokens->first()
    );
});

it('should logout', function () {
    /** @var \Tests\TestCase $this */
    $administrator = Administrator::factory()
        ->create();

    Sanctum::actingAs($administrator);

    $response = $this->postJson(
        uri: route(
            name: 'api.mng.auth.logout',
        ),
    );

    $response->assertNoContent();
});


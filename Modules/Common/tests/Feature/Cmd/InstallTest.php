<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Administrator\Models\Administrator;
use Spatie\Permission\Models\Role;

uses(
    RefreshDatabase::class,
);

it('should run installation', function () {
    /** @var \Tests\TestCase $this */
    $this->artisan(
        command: 'app:install',
    );

    expect(Administrator::count())->toBe(1);
    expect(Role::count())->toBe(1);
});

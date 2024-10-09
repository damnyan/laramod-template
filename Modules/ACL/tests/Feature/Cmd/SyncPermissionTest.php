<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Administrator\Models\Administrator;
use Spatie\Permission\Models\Role;

uses(
    RefreshDatabase::class,
);

it(
    description: 'should sync permissions and seed to administrator\s permissions',
    closure: function () {
        Administrator::factory()->create();
        $this->artisan(
            command: 'app:permission:sync',
            parameters: [],
        );
        expect(Role::count())->toBe(1);
    }
);


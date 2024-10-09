<?php

it('should rollback', function () {
    /** @var \Tests\TestCase $this */
    $this->artisan('migrate')->assertExitCode(0);
    $this->artisan('migrate:rollback')->assertExitCode(0);
});

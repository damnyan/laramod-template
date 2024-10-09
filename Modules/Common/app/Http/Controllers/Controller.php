<?php

namespace Modules\Common\Http\Controllers;

use App\Http\Controllers\Controller as ControllersController;

class Controller extends ControllersController
{
    /**
     * Get per page
     *
     * @param integer $default
     * @param integer $max
     * @return integer
     */
    protected function getPerPage(int $default = 50, int $max = 10000): int
    {
        $default = config('pagination.default_per_page', $default);

        $perPage = request()->get('per_page', $default);

        if ($perPage > $max) {
            $perPage = $max;
        }

        return $perPage;
    }
}

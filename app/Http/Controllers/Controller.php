<?php

namespace App\Http\Controllers;

use App\Traits\ShopifyTrait;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use ShopifyTrait;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

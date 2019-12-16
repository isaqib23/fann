<?php

use App\Contracts\PlacementRepository;


function getPlacementIdBySlug($slug)
{
    $placementRepo = app()->make(PlacementRepository::class);
    $placement = $placementRepo->findByField('slug', $slug)->first();

    return $placement->id;
}

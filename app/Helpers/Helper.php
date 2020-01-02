<?php

use App\Contracts\PlacementRepository;
use App\Contracts\PlacementTypeRepository;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * @param $slug
 * @return mixed
 * @throws BindingResolutionException
 */
function getPlacementIdBySlug($slug)
{
    $placementRepo = app()->make(PlacementRepository::class);
    $placement = $placementRepo->findByField('slug', $slug)->first();

    return $placement->id;
}

/**
 * @param $slug
 * @return mixed
 * @throws BindingResolutionException
 */
function getPlacementTypeBySlug($slug)
{
    $placementTypeRepo = app()->make(PlacementTypeRepository::class);
    $placementType = $placementTypeRepo->findByField('slug', $slug)->first();

    return $placementType->id;
}

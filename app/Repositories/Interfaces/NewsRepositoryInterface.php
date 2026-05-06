<?php

namespace App\Repositories\Interfaces;

interface NewsRepositoryInterface extends BaseRepositoryInterface
{
    public function getPublishedNews($perPage = 9);
    public function getBySlug($slug);
    public function getRecommendations($excludeId, $limit = 2);
}

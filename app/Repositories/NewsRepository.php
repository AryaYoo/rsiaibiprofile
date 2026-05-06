<?php

namespace App\Repositories;

use App\Models\News;
use App\Repositories\Interfaces\NewsRepositoryInterface;

class NewsRepository implements NewsRepositoryInterface
{
    protected $model;

    public function __construct(News $news)
    {
        $this->model = $news;
    }

    public function all()
    {
        return $this->model->latest()->get();
    }

    public function getPublishedNews($perPage = 9)
    {
        return $this->model->where('is_published', true)->latest()->paginate($perPage);
    }

    public function getBySlug($slug)
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }

    public function getRecommendations($excludeId, $limit = 2)
    {
        return $this->model->where('id', '!=', $excludeId)
            ->where('is_published', true)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->find($id);
        $record->update($data);
        return $record;
    }

    public function delete($id)
    {
        $record = $this->find($id);
        return $record->delete();
    }
}

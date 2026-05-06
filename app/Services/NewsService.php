<?php

namespace App\Services;

use App\Repositories\Interfaces\NewsRepositoryInterface;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsService
{
    protected $newsRepository;

    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getPublishedNews($perPage = 9)
    {
        return $this->newsRepository->getPublishedNews($perPage);
    }

    public function getNewsBySlug($slug)
    {
        return $this->newsRepository->getBySlug($slug);
    }

    public function getRecommendations($excludeId)
    {
        return $this->newsRepository->getRecommendations($excludeId);
    }

    public function getSidebarAd()
    {
        return Setting::where('key', 'news_sidebar_ad')->value('value');
    }

    public function getAllNews($perPage = null)
    {
        return $this->newsRepository->all($perPage);
    }

    public function storeNews(array $data, $image = null)
    {
        $data['slug'] = Str::slug($data['title']);
        
        if ($image) {
            $data['image'] = $image->store('news', 'public');
        }

        return $this->newsRepository->create($data);
    }

    public function updateNews($id, array $data, $image = null)
    {
        $news = $this->newsRepository->find($id);
        $data['slug'] = Str::slug($data['title']);

        if ($image) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $image->store('news', 'public');
        }

        return $this->newsRepository->update($id, $data);
    }

    public function deleteNews($id)
    {
        $news = $this->newsRepository->find($id);
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        return $this->newsRepository->delete($id);
    }
}

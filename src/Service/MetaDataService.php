<?php

namespace App\Service;

class MetaDataService
{
    public function generateMetaTags(string $title, string $description, string $url, string $img): array
    {
        return [
            'title' => $title,
            'description' => $description,
            'url' => $url,
            'canonical' => $url,
            'og_title' => $title,
            'og_image' => $img ?? 'https://example.com/default-image.jpg',
            'og_description' => $description,
            'og_url' => $url,
            'og_type' => 'website',
            'twitter_card' => 'summary_large_image',
        ];
    }
}

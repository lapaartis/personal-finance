<?php

namespace App\Services\Categories;

use App\Models\Categories\Category;

class StoreCategory
{
    private $user;
    private $name;

    public function __construct($user, $data)
    {
        $this->user = $user;
        $this->hydrateLocal($data);
    }

    public function store(): bool
    {
        $category = new Category();

        $category->user_id = $this->user->id;
        $category->name = $this->name;

        return $category->save();
    }

    private function hydrateLocal($data): void
    {
        $this->name = $data['name'];
    }
}

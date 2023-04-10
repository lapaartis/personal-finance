<?php

namespace App\Services\Categories;

use App\Models\Categories\Category;

class UpdateCategory
{
    private $user;
    private $name;
    private $category;

    public function __construct($user, Category $category, $data)
    {
        $this->user = $user;
        $this->category = $category;
        $this->hydrateLocal($data);
    }

    public function update(): bool
    {
        $category = $this->category;

        $category->name = $this->name;

        return $category->save();
    }

    private function hydrateLocal($data): void
    {
        $this->name = $data['name'];
    }
}

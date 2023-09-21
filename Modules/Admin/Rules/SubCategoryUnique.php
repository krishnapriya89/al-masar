<?php

namespace Modules\Admin\Rules;

use App\Models\ProductSubCategory;
use Illuminate\Contracts\Validation\Rule;

class SubCategoryUnique implements Rule
{

    protected $categoryId;
    protected $excludeSubCategoryId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($categoryId, $excludeSubCategoryId = null)
    {
        $this->categoryId = $categoryId;
        $this->excludeSubCategoryId = $excludeSubCategoryId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $query = ProductSubCategory::where('product_main_category_id', $this->categoryId)
            ->where('title', $value);

        if ($this->excludeSubCategoryId !== null) {
            $query->where('id', '!=', $this->excludeSubCategoryId);
        }

        return !$query->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The sub category must be unique within the selected category.';
    }
}

<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;


class Indexx extends Component
{
    public $products, $category, $brandInputs = [], $priceInput;

    protected $queryString = [
        'brandInputs' => ['except' => '', 'as' => 'brand'],
        'priceInput' => ['except' => '', 'as' => 'price'],
    ];

    public function mount($category)
    {
        $this->category = $category;
    }

    public function updatedBrandInputs()
    {
        $this->updateProducts();
    }

    public function updateProducts()
    {
        $this->products = Product::where('category_id', $this->category->id)
            ->when($this->brandInputs, function ($q) {
                $q->whereIn('brand', $this->brandInputs);
            })
            ->when($this->priceInput, function ($q) {

                $q->when($this->priceInput == 'high-to-low', function ($q2) {

                    $q2->orderBy('selling_price', 'DESC');
                })
                    ->when($this->priceInput == 'low-to-high', function ($q2) {
                        $q2->orderBy('selling_price', 'ASC');
                    });
            })
            ->where('status', '0')
            ->get();
    }

    public function render()
    {
        $this->updateProducts();

        return view('livewire.frontend.product.indexx', [
            'products' => $this->products,
            'category' => $this->category,
        ]);
    }
}

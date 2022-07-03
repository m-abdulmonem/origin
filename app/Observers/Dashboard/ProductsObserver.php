<?php

namespace App\Observers\Dashboard;

use App\Http\Controllers\Dashboard\Utils\MediaControllers;
use App\Models\Product\Product;
use App\Models\Product\ProductGroupSlug;

class ProductsObserver
{
    public function created(Product $product)
    {
        $request = request();


        MediaControllers::addMedia($request,$product);

        $product->categories()->sync($request->categories);


        if (($varients = $request->varient_name) != null) {

            foreach ($varients as $varient) {
                if ($varient !=null) {
                    $createdVar = $product->varients()->create([
                        'title' => $varient,
                        'description' => "",
                        'type'=> 'options'
                    ]);
                foreach ($request->$varient as $key => $value) {
                    if ($value != null) {
                         $qun = $varient."_quntity";

                    $createdVar->slugs()->create([
                        'slug' => $value,
                        'value' => $request->$qun[$key]
                    ]);
                    }
                }
                }
            }
        }
    }

        /**
     * Handle the category "updated" event.
     *
     * @param Category $category
     * @return void
     */
    public function updated(Product $product)
    {

        MediaControllers::addMedia($request,$product);

        $product->categories()->toggle($request->categories);

         if (($varients = $request->varient_name) != null) {

            foreach ($varients as $varient) {
                if ($varient !=null) {
                    $varientData = [
                        'title' => $varient,
                        'description' => "",
                        'type'=> 'options'
                    ];

                    $productGroup = ProductGroup::where("title",$varient)->where("product_id",$product->id)->first();

                    if ($productGroup) {
                        $productGroup->udpate($varientData);
                    }else{
                        $createdVar = $product->varients()->create($varientData);
                    }
                foreach ($request->$varient as $key => $value) {
                    if ($value != null) {

                         $qun = $varient."_quntity";

                         $slug = ProductGroupSlug::where("slug",$value)->where("product_group_id",)->first();

                         $slugData = [
                                'slug' => $value,
                                'value' => $request->$qun[$key]
                            ];

                         if ($slug == null) {
                            $createdVar->slugs()->create($slugData);
                         }else{
                            $slug->update($slugData);
                         }
                    }
                }
                }
            }
        }
    }
}

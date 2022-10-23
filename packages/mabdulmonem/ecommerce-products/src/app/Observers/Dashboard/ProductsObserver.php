<?php

namespace Observers\Dashboard;

use App\Http\Controllers\Dashboard\Utils\MediaControllers;
use Mabdulmonem\Uploader\Http\Models\Product\Product;
use Mabdulmonem\Uploader\Http\Models\Product\ProductGroup;
use Mabdulmonem\Uploader\Http\Models\Product\ProductGroupSlug;

class ProductsObserver
{

    /**
     *
     * @param Product $product
     * @return void
     */
    public function created(Product $product): void
    {
        $request = request();


        MediaControllers::attachMedia($request,$product);

        $product->categories()->sync($request->categories);


        if (($variants = $request->variant_name) != null) {

            foreach ($variants as $variant) {
                if ($variant !=null) {
                    $createdVar = $product->variants()->create([
                        'title' => $variant,
                        'description' => "",
                        'type'=> 'options'
                    ]);
                foreach ($request->$variant as $key => $value) {
                    if ($value != null) {
                         $qun = $variant."_quantity";

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
     * @param Product $product
     * @return void
     */
    public function updated(Product $product)
    {

        $request = request();

        MediaControllers::attachMedia($request,$product);

        $product->categories()->toggle($request->categories);

         if (($variants = $request->varient_name) != null) {

            foreach ($variants as $variant) {
                if ($variant !=null) {
                    $variantData = [
                        'title' => $variant,
                        'description' => "",
                        'type'=> 'options'
                    ];

                    $productGroup = ProductGroup::where("title",$variant)->where("product_id",$product->id)->first();

                    if ($productGroup) {
                        $productGroup->udpate($variantData);
                    }else{
                        $createdVar = $product->varients()->create($variantData);
                    }
                foreach ($request->$variant as $key => $value) {
                    if ($value != null) {

                         $qun = $variant."_quantity";

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

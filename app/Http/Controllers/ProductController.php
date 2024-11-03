<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportCsvRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function importCsv(ImportCsvRequest $request)
    {
        $file = $request->file;

        $fileContents = file($file->getPathname());

        $c = 1;

        foreach ($fileContents as $line) {
            // skip first line
            if ($c != 1) {
                // read line data as array
                $data = str_getcsv($line);
                // reverse the result
                $reversed_array = array_reverse($data);
                // pop name
                $name = array_pop($reversed_array);
                // pop price
                $price = array_pop($reversed_array);
                // remaining array contains categories, can be empty
                $categories = $reversed_array;
                // create product
                $product = Product::updateOrCreate(
                    [
                        'name' => $name
                    ],
                    [
                        'name' => $name,
                        'price' => $price,
                    ]
                );

                $new_categories = [];
                // build new category relation array
                if (sizeof($categories) > 0) {
                    foreach ($categories as $category) {
                        $category = Category::updateOrCreate(
                            [
                                'name' => $category
                            ], [
                                'name' => $category
                            ]
                        );

                        $new_categories[] = $category->id;
                    }
                }
                // sync relations or remove all existing relation
                $product->categories()->sync($new_categories);
            }

            $c++;
        }

        return redirect()->back()->with('success', 'Az állomány importálása és feldolgozása sikeresen megtörtént.');
    }
}

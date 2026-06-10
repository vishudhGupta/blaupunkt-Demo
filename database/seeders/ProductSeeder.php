<?php

namespace Database\Seeders;

use App\Models\Locale;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Product definitions with translations
        $products = [
            [
                'sku' => 'DC-1',
                'category' => 'DC',
                'translations' => [
                    'eu-en' => ['name' => 'DC 1', 'description' => 'DC Product 1 - European Edition'],
                    'eu-de' => ['name' => 'DC 1', 'description' => 'DC Produkt 1 - Deutsche Version'],
                    'eu-fr' => ['name' => 'DC 1', 'description' => 'Produit DC 1 - Édition Française'],
                    'ae-en' => ['name' => 'DC 1', 'description' => 'DC Product 1 - UAE Edition'],
                    'ae-ar' => ['name' => 'DC 1', 'description' => 'منتج DC 1 - الطبعة الإماراتية'],
                ],
                'markets' => ['eu-en', 'eu-de', 'eu-fr', 'ae-en', 'ae-ar'],
                'variants' => 3,
            ],
            [
                'sku' => 'DC-2',
                'category' => 'DC',
                'translations' => [
                    'ae-en' => ['name' => 'DC 2', 'description' => 'DC Product 2 - UAE Edition'],
                    'ae-ar' => ['name' => 'DC 2', 'description' => 'منتج DC 2 - الطبعة الإماراتية'],
                    'sa-en' => ['name' => 'DC 2', 'description' => 'DC Product 2 - Saudi Edition'],
                    'sa-ar' => ['name' => 'DC 2', 'description' => 'منتج DC 2 - الطبعة السعودية'],
                    'cm-en' => ['name' => 'DC 2', 'description' => 'DC Product 2 - Cameroon Edition'],
                    'cm-fr' => ['name' => 'DC 2', 'description' => 'Produit DC 2 - Édition Cameroun'],
                    'in-en' => ['name' => 'DC 2', 'description' => 'DC Product 2 - India Edition'],
                    'ng-en' => ['name' => 'DC 2', 'description' => 'DC Product 2 - Nigeria Edition'],
                ],
                'markets' => ['ae-en', 'ae-ar', 'sa-en', 'sa-ar', 'cm-en', 'cm-fr', 'in-en', 'ng-en'],
                'variants' => 3,
            ],
            [
                'sku' => 'AC-1',
                'category' => 'AC',
                'translations' => [
                    'eu-en' => ['name' => 'AC 1', 'description' => 'AC Product 1 - European Edition'],
                    'eu-de' => ['name' => 'AC 1', 'description' => 'AC Produkt 1 - Deutsche Version'],
                    'eu-fr' => ['name' => 'AC 1', 'description' => 'Produit AC 1 - Édition Française'],
                ],
                'markets' => ['eu-en', 'eu-de', 'eu-fr'],
                'variants' => 3,
            ],
            [
                'sku' => 'AC-2',
                'category' => 'AC',
                'translations' => [
                    'eu-en' => ['name' => 'AC 2', 'description' => 'AC Product 2 - European Edition'],
                    'eu-de' => ['name' => 'AC 2', 'description' => 'AC Produkt 2 - Deutsche Version'],
                    'eu-fr' => ['name' => 'AC 2', 'description' => 'Produit AC 2 - Édition Française'],
                    'ae-en' => ['name' => 'AC 2', 'description' => 'AC Product 2 - UAE Edition'],
                    'ae-ar' => ['name' => 'AC 2', 'description' => 'منتج AC 2 - الطبعة الإماراتية'],
                    'sa-en' => ['name' => 'AC 2', 'description' => 'AC Product 2 - Saudi Edition'],
                    'sa-ar' => ['name' => 'AC 2', 'description' => 'منتج AC 2 - الطبعة السعودية'],
                    'cm-en' => ['name' => 'AC 2', 'description' => 'AC Product 2 - Cameroon Edition'],
                    'cm-fr' => ['name' => 'AC 2', 'description' => 'Produit AC 2 - Édition Cameroun'],
                    'in-en' => ['name' => 'AC 2', 'description' => 'AC Product 2 - India Edition'],
                    'ng-en' => ['name' => 'AC 2', 'description' => 'AC Product 2 - Nigeria Edition'],
                ],
                'markets' => ['eu-en', 'eu-de', 'eu-fr', 'ae-en', 'ae-ar', 'sa-en', 'sa-ar', 'cm-en', 'cm-fr', 'in-en', 'ng-en'],
                'variants' => 3,
            ],
            [
                'sku' => 'CABLE-1',
                'category' => 'Cables',
                'translations' => [
                    'eu-en' => ['name' => 'Cable 1', 'description' => 'Premium Cable 1 - European Edition'],
                    'eu-de' => ['name' => 'Kabel 1', 'description' => 'Premium Kabel 1 - Deutsche Version'],
                    'eu-fr' => ['name' => 'Câble 1', 'description' => 'Câble Premium 1 - Édition Française'],
                    'ae-en' => ['name' => 'Cable 1', 'description' => 'Premium Cable 1 - UAE Edition'],
                    'ae-ar' => ['name' => 'كابل 1', 'description' => 'كابل بريميوم 1 - الطبعة الإماراتية'],
                    'sa-en' => ['name' => 'Cable 1', 'description' => 'Premium Cable 1 - Saudi Edition'],
                    'sa-ar' => ['name' => 'كابل 1', 'description' => 'كابل بريميوم 1 - الطبعة السعودية'],
                    'cm-en' => ['name' => 'Cable 1', 'description' => 'Premium Cable 1 - Cameroon Edition'],
                    'cm-fr' => ['name' => 'Câble 1', 'description' => 'Câble Premium 1 - Édition Cameroun'],
                    'in-en' => ['name' => 'Cable 1', 'description' => 'Premium Cable 1 - India Edition'],
                    'ng-en' => ['name' => 'Cable 1', 'description' => 'Premium Cable 1 - Nigeria Edition'],
                ],
                'markets' => ['eu-en', 'eu-de', 'eu-fr', 'ae-en', 'ae-ar', 'sa-en', 'sa-ar', 'cm-en', 'cm-fr', 'in-en', 'ng-en'],
                'variants' => 3,
                'variant_note' => 'EU: 3 variants, Others: 1 variant',
            ],
            [
                'sku' => 'CABLE-2',
                'category' => 'Cables',
                'translations' => [
                    'eu-en' => ['name' => 'Cable 2', 'description' => 'Professional Cable 2 - European Edition'],
                    'eu-de' => ['name' => 'Kabel 2', 'description' => 'Professionelles Kabel 2 - Deutsche Version'],
                    'eu-fr' => ['name' => 'Câble 2', 'description' => 'Câble Professionnel 2 - Édition Française'],
                    'ae-en' => ['name' => 'Cable 2', 'description' => 'Professional Cable 2 - UAE Edition'],
                    'ae-ar' => ['name' => 'كابل 2', 'description' => 'كابل احترافي 2 - الطبعة الإماراتية'],
                    'sa-en' => ['name' => 'Cable 2', 'description' => 'Professional Cable 2 - Saudi Edition'],
                    'sa-ar' => ['name' => 'كابل 2', 'description' => 'كابل احترافي 2 - الطبعة السعودية'],
                    'cm-en' => ['name' => 'Cable 2', 'description' => 'Professional Cable 2 - Cameroon Edition'],
                    'cm-fr' => ['name' => 'Câble 2', 'description' => 'Câble Professionnel 2 - Édition Cameroun'],
                    'in-en' => ['name' => 'Cable 2', 'description' => 'Professional Cable 2 - India Edition'],
                    'ng-en' => ['name' => 'Cable 2', 'description' => 'Professional Cable 2 - Nigeria Edition'],
                ],
                'markets' => ['eu-en', 'eu-de', 'eu-fr', 'ae-en', 'ae-ar', 'sa-en', 'sa-ar', 'cm-en', 'cm-fr', 'in-en', 'ng-en'],
                'variants' => 2,
                'variant_note' => 'EU: 2 variants, Others: 3 variants',
            ],
            [
                'sku' => 'CABLE-3',
                'category' => 'Cables',
                'translations' => [
                    'ae-en' => ['name' => 'Cable 3', 'description' => 'Industrial Cable 3 - UAE Edition'],
                    'ae-ar' => ['name' => 'كابل 3', 'description' => 'كابل صناعي 3 - الطبعة الإماراتية'],
                    'sa-en' => ['name' => 'Cable 3', 'description' => 'Industrial Cable 3 - Saudi Edition'],
                    'sa-ar' => ['name' => 'كابل 3', 'description' => 'كابل صناعي 3 - الطبعة السعودية'],
                    'cm-en' => ['name' => 'Cable 3', 'description' => 'Industrial Cable 3 - Cameroon Edition'],
                    'cm-fr' => ['name' => 'Câble 3', 'description' => 'Câble Industriel 3 - Édition Cameroun'],
                    'in-en' => ['name' => 'Cable 3', 'description' => 'Industrial Cable 3 - India Edition'],
                    'ng-en' => ['name' => 'Cable 3', 'description' => 'Industrial Cable 3 - Nigeria Edition'],
                ],
                'markets' => ['ae-en', 'ae-ar', 'sa-en', 'sa-ar', 'cm-en', 'cm-fr', 'in-en', 'ng-en'],
                'variants' => 3,
            ],
        ];

        $euCountries = ['eu-en', 'eu-de', 'eu-fr'];

        foreach ($products as $productData) {
            $product = Product::query()->updateOrCreate(
                ['sku' => $productData['sku']],
                ['status' => 'published']
            );

            // Create variants - special handling for Cable 1 and Cable 2
            $variantCount = $productData['variants'];
            
            // For Cable 1: EU has 3 variants, others have 1
            if ($productData['sku'] === 'CABLE-1') {
                foreach ($productData['translations'] as $locale => $translationData) {
                    $numVariants = in_array($locale, $euCountries) ? 3 : 1;
                    $this->createProductVariants($product, $numVariants, $productData['sku']);
                }
            }
            // For Cable 2: EU has 2 variants, others have 3
            elseif ($productData['sku'] === 'CABLE-2') {
                foreach ($productData['translations'] as $locale => $translationData) {
                    $numVariants = in_array($locale, $euCountries) ? 2 : 3;
                    $this->createProductVariants($product, $numVariants, $productData['sku']);
                }
            } else {
                // All other products have consistent variants
                $this->createProductVariants($product, $variantCount, $productData['sku']);
            }

            // Create translations
            foreach ($productData['translations'] as $localeCode => $translationData) {
                $locale = Locale::where('code', $localeCode)->first();
                if ($locale) {
                    ProductTranslation::query()->updateOrCreate(
                        [
                            'product_id' => $product->id,
                            'locale_id' => $locale->id,
                        ],
                        [
                            'name' => $translationData['name'],
                            'slug' => \Illuminate\Support\Str::slug($translationData['name']),
                            'short_description' => $translationData['description'] ?? null,
                            'description' => '<p>' . $translationData['description'] . '</p>',
                            'seo_title' => $translationData['name'],
                            'seo_description' => $translationData['description'],
                        ]
                    );
                }
            }

            // Create market assignments
            foreach ($productData['markets'] as $marketLocaleCode) {
                $locale = Locale::where('code', $marketLocaleCode)->first();
                if ($locale && !$product->markets()->where('locale_id', $locale->id)->exists()) {
                    $product->markets()->attach($locale);
                }
            }
        }
    }

    private function createProductVariants(Product $product, int $count, string $productSku): void
    {
        // Only create variants if they don't exist
        if ($product->variants()->count() > 0) {
            return;
        }

        for ($i = 1; $i <= $count; $i++) {
            ProductVariant::query()->updateOrCreate(
                ['sku' => "{$productSku}-V{$i}"],
                [
                    'product_id' => $product->id,
                    'name' => "Variant {$i}",
                    'description' => "Variant {$i} of {$productSku}",
                    'status' => 'active',
                ]
            );
        }
    }
}

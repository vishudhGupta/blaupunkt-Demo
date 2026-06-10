<?php

namespace Tests\Feature;

use Tests\TestCase;

class LocaleRouteValidationTest extends TestCase
{
    public function test_invalid_locale_returns_not_found(): void
    {
        $this->get('/xx-en/products')->assertNotFound();
    }

    public function test_sitemap_index_is_reachable(): void
    {
        $this->get('/sitemap.xml')->assertOk();
    }
}

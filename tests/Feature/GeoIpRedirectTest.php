<?php

namespace Tests\Feature;

use Tests\TestCase;

class GeoIpRedirectTest extends TestCase
{
    public function test_root_redirects_to_country_locale_when_supported(): void
    {
        $response = $this->withHeaders([
            'CF-IPCountry' => 'DE',
        ])->get('/');

        $response->assertStatus(302);
        $response->assertRedirect('/eu-de');
    }

    public function test_root_does_not_redirect_for_unsupported_country(): void
    {
        $response = $this->withHeaders([
            'CF-IPCountry' => 'BR',
        ])->get('/');

        $response->assertOk();
    }
}

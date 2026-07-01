<?php

namespace Tests\Feature;

use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShortLinkTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\PreventRequestForgery::class);
    }

    public function test_guest_cannot_access_links_page(): void
    {
        $response = $this->get(route('links.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_user_can_create_short_link(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('links.store'), [
            'original_url' => 'https://example.com',
        ]);

        $response->assertRedirect(route('links.index'));
        $this->assertDatabaseHas('short_links', [
            'original_url' => 'https://example.com',
            'user_id' => $user->id,
        ]);
    }

    public function test_short_link_redirects_to_original_url(): void
    {
        $link = ShortLink::factory()->create([
            'original_url' => 'https://example.com/test',
        ]);

        $response = $this->get('/' . $link->short_code);

        $response->assertRedirect('https://example.com/test');
    }

    public function test_redirect_tracks_click(): void
    {
        $link = ShortLink::factory()->create();

        $this->get('/' . $link->short_code);

        $this->assertDatabaseHas('clicks', [
            'short_link_id' => $link->id,
        ]);

        $this->assertEquals(1, $link->fresh()->clicks_count);
    }

    public function test_user_can_delete_own_link(): void
    {
        $user = User::factory()->create();
        $link = ShortLink::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete(route('links.destroy', $link));

        $response->assertRedirect(route('links.index'));
        $this->assertDatabaseMissing('short_links', ['id' => $link->id]);
    }

    public function test_user_cannot_delete_others_link(): void
    {
        $owner = User::factory()->create();
        $attacker = User::factory()->create();
        $link = ShortLink::factory()->create(['user_id' => $owner->id]);

        $response = $this->actingAs($attacker)->delete(route('links.destroy', $link));

        $response->assertForbidden();
        $this->assertDatabaseHas('short_links', ['id' => $link->id]);
    }
}

<?php

namespace Tests\Feature;

use App\Mail\QuoteReceived;
use App\Models\QuoteRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_renders_seeded_content(): void
    {
        $this->seed();
        $this->get('/')->assertOk()->assertSee('Rusumo Hydro Power Plant')->assertSee('Pitch lit for night play')->assertSee('images/site/pitch-lighting-night.jpg');
    }

    public function test_quote_is_stored_and_emailed(): void
    {
        Mail::fake();
        $this->post('/quote', ['name' => 'Jane', 'contact' => 'jane@x.rw', 'service' => 'MV and LV line installation', 'message' => 'Hi'])
            ->assertRedirect();
        $this->assertDatabaseHas('quote_requests', ['name' => 'Jane']);
        Mail::assertSent(QuoteReceived::class);
    }

    public function test_quote_validation_and_honeypot(): void
    {
        $this->post('/quote', [])->assertSessionHasErrors(['name', 'contact']);
        $this->post('/quote', ['name' => 'Bot', 'contact' => 'x', 'website' => 'spam']);
        $this->assertSame(0, QuoteRequest::count());
    }

    public function test_admin_requires_login_and_can_manage_content(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->actingAs(User::factory()->create());
        $this->get('/admin')->assertOk();
        $this->post('/admin/services', ['title' => 'T', 'description' => 'D', 'icon' => 'bolt'])->assertRedirect('/admin/services');
        $this->get('/admin/services')->assertOk()->assertSee('T');
        $this->get('/admin/projects/create')->assertOk();
    }
}

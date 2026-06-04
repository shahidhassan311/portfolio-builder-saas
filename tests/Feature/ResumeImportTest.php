<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ResumeImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_includes_resume_import_script_for_free_users(): void
    {
        $user = User::factory()->create(['plan' => 'free', 'username' => 'testuser']);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('id="resume-dropzone"', false);
        $response->assertSee('function uploadResume', false);
        $response->assertSee('importUrl', false);
    }

    public function test_resume_import_accepts_txt_file(): void
    {
        $user = User::factory()->create(['plan' => 'free', 'username' => 'testuser']);
        $fixture = base_path('tests/fixtures/sample-resume.txt');

        $response = $this->actingAs($user)->postJson(route('dashboard.resume.import'), [
            'resume' => new UploadedFile($fixture, 'resume.txt', 'text/plain', null, true),
        ]);

        $response->assertOk()
            ->assertJson(['status' => 'success']);

        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Jane Developer']);
    }
}

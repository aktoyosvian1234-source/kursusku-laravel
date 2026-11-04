<?php

namespace Tests\Feature;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Halaman memakai @vite; di test, aset tidak perlu dibangun.
        $this->withoutVite();
    }

    private function validData(array $override = []): array
    {
        return array_merge([
            'code'        => 'WEB-101',
            'name'        => 'Web Dasar',
            'description' => 'HTML dan CSS dasar.',
            'fee'         => 300000,
            'quota'       => 25,
            'start_date'  => '2026-12-01',
            'status'      => 'open',
        ], $override);
    }

    private function makeCourse(array $override = []): Course
    {
        return Course::create($this->validData($override));
    }

    public function test_index_page_is_accessible_and_displays_courses(): void
    {
        $this->makeCourse();

        $this->get(route('courses.index'))
            ->assertOk()
            ->assertSee('WEB-101')
            ->assertSee('Web Dasar');
    }

    public function test_create_page_is_accessible(): void
    {
        $this->get(route('courses.create'))->assertOk();
    }

    public function test_store_valid_course_successfully_creates_record(): void
    {
        $this->post(route('courses.store'), $this->validData())
            ->assertRedirect(route('courses.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('courses', ['code' => 'WEB-101', 'name' => 'Web Dasar']);
    }

    public function test_validation_rejects_empty_code(): void
    {
        $this->post(route('courses.store'), $this->validData(['code' => '']))
            ->assertSessionHasErrors('code');

        $this->assertDatabaseCount('courses', 0);
    }

    public function test_validation_rejects_code_longer_than_20_chars(): void
    {
        $this->post(route('courses.store'), $this->validData(['code' => str_repeat('A', 21)]))
            ->assertSessionHasErrors('code');

        $this->assertDatabaseCount('courses', 0);
    }

    public function test_validation_rejects_name_longer_than_120_chars(): void
    {
        $this->post(route('courses.store'), $this->validData(['name' => str_repeat('a', 121)]))
            ->assertSessionHasErrors('name');

        $this->assertDatabaseCount('courses', 0);
    }

    public function test_validation_rejects_invalid_quota(): void
    {
        foreach ([0, -1, 'abc'] as $quota) {
            $this->post(route('courses.store'), $this->validData(['quota' => $quota]))
                ->assertSessionHasErrors('quota');
        }

        $this->assertDatabaseCount('courses', 0);
    }

    public function test_validation_rejects_invalid_status(): void
    {
        $this->post(route('courses.store'), $this->validData(['status' => 'active']))
            ->assertSessionHasErrors('status');

        $this->assertDatabaseCount('courses', 0);
    }

    public function test_show_page_is_accessible_and_displays_course_details(): void
    {
        $course = $this->makeCourse();

        $this->get(route('courses.show', $course))
            ->assertOk()
            ->assertSee('WEB-101')
            ->assertSee('Web Dasar')
            ->assertSee('300.000');
    }

    public function test_show_non_existent_course_returns_404(): void
    {
        $this->get('/courses/999999')->assertNotFound();
    }

    public function test_store_rejects_duplicate_code(): void
    {
        $this->makeCourse();

        $this->post(route('courses.store'), $this->validData(['name' => 'Nama Lain']))
            ->assertSessionHasErrors('code');

        $this->assertDatabaseCount('courses', 1);
    }

    public function test_quota_boundary_500_valid_and_501_invalid(): void
    {
        $this->post(route('courses.store'), $this->validData(['code' => 'Q-500', 'quota' => 500]))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('courses', ['code' => 'Q-500', 'quota' => 500]);

        $this->post(route('courses.store'), $this->validData(['code' => 'Q-501', 'quota' => 501]))
            ->assertSessionHasErrors('quota');
        $this->assertDatabaseMissing('courses', ['code' => 'Q-501']);
    }

    public function test_validation_rejects_invalid_start_date(): void
    {
        $this->post(route('courses.store'), $this->validData(['start_date' => 'bukan-tanggal']))
            ->assertSessionHasErrors('start_date');

        $this->assertDatabaseCount('courses', 0);
    }

    public function test_edit_page_is_accessible_and_displays_current_data(): void
    {
        $course = $this->makeCourse();

        $this->get(route('courses.edit', $course))
            ->assertOk()
            ->assertSee('WEB-101')
            ->assertSee('Web Dasar');
    }

    public function test_update_course_keeping_same_code_succeeds(): void
    {
        $course = $this->makeCourse();

        $this->put(route('courses.update', $course), $this->validData(['name' => 'Web Dasar Revisi']))
            ->assertRedirect(route('courses.show', $course))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('courses', ['id' => $course->id, 'code' => 'WEB-101', 'name' => 'Web Dasar Revisi']);
    }

    public function test_update_course_with_duplicate_code_of_another_course_fails(): void
    {
        $this->makeCourse();
        $other = $this->makeCourse(['code' => 'PHP-101', 'name' => 'PHP Dasar']);

        $this->put(route('courses.update', $other), $this->validData(['code' => 'WEB-101', 'name' => 'PHP Dasar']))
            ->assertSessionHasErrors('code');

        $this->assertDatabaseHas('courses', ['id' => $other->id, 'code' => 'PHP-101']);
    }

    public function test_destroy_course_successfully_deletes_record(): void
    {
        $course = $this->makeCourse();

        $this->delete(route('courses.destroy', $course))
            ->assertRedirect(route('courses.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
    }
}
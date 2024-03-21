<?php

namespace Tests\Feature;

use App\Http\Requests\Project\IndexProjectRequest;
use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepository;
use App\Services\Interfaces\ProjectService;
use App\Services\ProjectServiceImpl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery;
use Tests\TestCase;

class ProjectServiceTest extends TestCase
{
    use RefreshDatabase;

    protected ProjectRepository $repository;
    protected ProjectService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = Mockery::mock(ProjectRepository::class);
        $this->app->instance(ProjectRepository::class, $this->repository);
        $this->service = new ProjectServiceImpl($this->repository);
    }

    public function testIndexMethod()
    {
        $limit = 8;
        $projects = Project::factory(10)->make();
        $expected = new LengthAwarePaginator($projects->forPage(1, $limit), $projects->count(), $limit);
        $this->repository->shouldReceive('index')
            ->once()
            ->with($limit)
            ->andReturn($expected);
        $request = Mockery::mock(IndexProjectRequest::class);
        $request->shouldReceive('validated')
            ->once()
            ->andReturn(['limit' => $limit]);
        $result = $this->service->index($request);
        $this->assertInstanceOf(LengthAwarePaginator::class, $expected);
        $this->assertEquals($expected->total(), $result->total());
        $this->assertCount($limit, $result->items());
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}

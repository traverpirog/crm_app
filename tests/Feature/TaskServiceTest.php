<?php

namespace Feature;

use App\Http\Requests\Task\IndexTaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Repositories\Interfaces\TaskRepository;
use App\Services\Interfaces\TaskService;
use App\Services\TaskServiceImpl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery;
use Tests\TestCase;

class TaskServiceTest extends TestCase
{
    use RefreshDatabase;

    protected TaskRepository $repository;
    protected TaskService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = Mockery::mock(TaskRepository::class);
        $this->app->instance(TaskRepository::class, $this->repository);
        $this->service = new TaskServiceImpl($this->repository);
    }

    public function testIndexMethod()
    {
        $limit = 8;
        Project::factory(1)->make();
        $tasks = Task::factory(10)->make();
        $expected = new LengthAwarePaginator($tasks->forPage(1, $limit), $tasks->count(), $limit, 1);
        $this->repository->shouldReceive('index')
            ->once()
            ->with($limit)
            ->andReturn($expected);
        $request = Mockery::mock(IndexTaskRequest::class);
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

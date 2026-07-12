<?php

namespace App\Http\Controllers;

use App\Application\Commands\CreateTargetCommand;
use App\Application\Commands\UpdateTargetCommand;
use App\Application\Exceptions\Targets\TargetNotFound;
use App\Application\Queries\Targets\GetTargetQuery;
use App\Application\Queries\Targets\ListTargetsQuery;
use App\Application\UseCases\Targets\CreateTargetUseCase;
use App\Application\UseCases\Targets\DeleteTargetUseCase;
use App\Application\UseCases\Targets\GetTargetUseCase;
use App\Application\UseCases\Targets\ListTargetsUseCase;
use App\Application\UseCases\Targets\UpdateTargetUseCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sites\ListSitesRequest;
use App\Http\Requests\Sites\ShowSiteRequest;
use App\Http\Requests\Sites\StoreSiteRequest;
use App\Http\Requests\Sites\UpdateSiteRequest;
use App\Http\Resources\SiteResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class SiteController extends Controller
{
    public function index(ListSitesRequest $request, ListTargetsUseCase $useCase): AnonymousResourceCollection
    {
        $sites = $useCase ->execute(new ListTargetsQuery(
            userId: $request->validated('user_id')
        ));

        return SiteResource::collection($sites);
    }

    public function store(StoreSiteRequest $request, CreateTargetUseCase $useCase): JsonResponse
    {
        $site = $useCase->execute(new CreateTargetCommand(
            userId: $request->validated('user_id'),
            name: $request->validated('name'),
            url: $request->validated('url')
        ));

        return (new SiteResource($site))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ShowSiteRequest $request, int $site, GetTargetUseCase $useCase): SiteResource|JsonResponse
    {
        try {
            $target = $useCase->execute(new GetTargetQuery(
                targetId: $site,
                userId: $request->validated('user_id')
            ));
        } catch (TargetNotFound $exception) {
            return response()->json(['message' => $exception->getMessage()],
            Response::HTTP_NOT_FOUND);
        }

        return new SiteResource($target);
    }

    public function update(UpdateSiteRequest $request, int $site, UpdateTargetUseCase $useCase): SiteResource|JsonResponse
    {
        try {
            $target = $useCase->execute(new UpdateTargetCommand(
                targetId: $site,
                userId: (int) $request->validated('user_id'),
                name: (string) $request->validated('name'),
                url: (string) $request->validated('url'),
                isPaused: $request->boolean('is_paused'),
            ));
        } catch (TargetNotFound $exception) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_NOT_FOUND);
        }

        return new SiteResource($target);
    }

    public function destroy(ShowSiteRequest $request, int $site, DeleteTargetUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute(new GetTargetQuery(
                targetId: $site,
                userId: (int) $request->validated('user_id'),
            ));
        } catch (TargetNotFound $exception) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_NOT_FOUND);
        }

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}

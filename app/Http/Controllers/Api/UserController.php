<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\FetchRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\UserResource;
use App\Services\UserCrudService;
use App\Services\UserService;
use App\Traits\ResponseApi;
use Illuminate\Http\Request;

class UserController extends Controller
{

    use ResponseApi;

    private $userCrudService;

    public function __construct(UserCrudService $userCrudService)
    {
        $this->userCrudService = $userCrudService;
    }

    /**
     * Fetch user
     *
     * @param FetchRequest $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function fetch(FetchRequest $request)
    {
        try {
            $user = $this->userCrudService->fetch($request->all());
            $res['result'] = UserResource::collection($user);
            $res['paginaition'] = new PaginationResource($user);
            return $this->success("Fetch user success", (object)$res);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }


    /**
     * Create user
     *
     * @param CreateRequest $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function create(CreateRequest $request)
    {
        try {
            $user = $this->userCrudService->create($request->all());
            $res = new UserResource($user);
            return $this->success("Create user success", $res);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Get user
     *
     * @param int $id
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function show(int $id)
    {
        try {
            $user = $this->userCrudService->getById($id);
            if($user) {
                $res = new UserResource($user);
                return $this->success("Create user success", $res);
            }
            return $this->error("User not found", 400);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Get user
     *
     * @param int $id
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function update(int $id, UpdateRequest $request)
    {
        try {
            $user = $this->userCrudService->update($id, $request->all());
            if($user) {
                $res = new UserResource($user);
                return $this->success("Update user success", $res);
            }
            return $this->error("Update failed", 400);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

     /**
     * Delete user
     *
     * @param int $id
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function delete(int $id)
    {
        try {
            $this->userCrudService->delete($id);
            return $this->success("Delete user success");
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}

<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Log;

class UserCrudService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Fetch user
     *
     * @param array $data
     * @return \App\Models\User
     */
    public function fetch(array $data)
    {
        try {
            $data = array_merge($data, [
                'sort_by'   => $data['sort_by'] ?? 'id',
                'sort_direction' => $data['sort_direction'] ?? 'DESC',
                'search'    => $data['search'] ?? null,
                'per_page'  => $data['per_page'] ?? 20,
                'page'      => $data['page'] ?? 1
            ]);

            return $this->userRepository->fetch($data);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            throw new \Exception("Internall error", 500);
        }
    }

    /**
     * Create user
     *
     * @param array $data
     * @return \App\Models\User
     */
    public function create(array $data)
    {
        try {
            $user = New User();
            $user->email = strtolower($data['email']);
            $user->name = $data['name'];
            $user->password = bcrypt($data['password']);
            return $this->userRepository->store($user);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            throw new \Exception("Internall error", 500);
        }
    }

    /**
     * Get user by ID
     *
     * @param int $id
     * @return \App\Models\User
     */
    public function getById(int $id)
    {
        try {
            return $this->userRepository->getById($id);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

     /**
     * Update user
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\User
     */
    public function update(int $id, array $data)
    {
        try {
            $user = $this->userRepository->getById($id);
            if(!$user) {
                throw new \Exception("User not found", 400);
            }

            $user->email = strtolower($data['email']);
            $user->name = $data['name'];
            if(!empty($data['password'])) {
                $user->password = bcrypt($data['password']);
            }
            return $this->userRepository->update($user);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

     /**
     * Update user
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        try {
            $user = $this->userRepository->getById($id);
            if(!$user) {
                throw new \Exception("User not found", 400);
            }
            return $this->userRepository->delete($user);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}

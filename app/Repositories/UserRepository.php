<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Log;

class UserRepository
{
    /**
     * Fetch users
     *
     * @param array $data
     * @return User
     */
    public function fetch(array $data)
    {
        return User::when(!empty($data['search']), function ($q) use ($data) {
                        return $q->where(function ($search) use ($data) {
                                    $search->where(\DB::RAW('LOWER(name)'), 'LIKE', '%' . strtolower($data['search']) . '%')
                                            ->orWhere(\DB::RAW('LOWER(email)'), 'LIKE', '%' . strtolower($data['search']) . '%');
                                });
                    })->orderBy($data['sort_by'], $data['sort_direction'])
                    ->paginate($data['per_page']);
    }

    /**
     * Store user to database
     *
     * @param User $user
     * @return User
     */
    public function store(User $user)
    {
        $user->save();
        $user->refresh();
        return $user;
    }

    /**
     * Get user by ID
     *
     * @param int $id
     * @return User
     */
    public function getById(int $id)
    {
        return User::where('id', $id)->first();
    }

    /**
     * Update user
     *
     * @param User $user
     * @return User
     */
    public function update(User $user)
    {
        $user->updated_at = NOW();
        $user->save();
        $user->refresh();
        return $user;
    }

    /**
     * Dekete user
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->delete();
    }
}

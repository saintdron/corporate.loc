<?php
/**
 * Created by PhpStorm.
 * User: Dron
 * Date: 14.09.2018
 * Time: 12:23
 */

namespace Corp\Repositories;


use Corp\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function addUser($request)
    {
        if (Gate::denies('create', $this->model)) {
            abort(403);
        }

        $data = $request->all();

        $user = $this->model->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'login' => $data['login']
        ]);

        if ($user) {
            $user->roles()->attach($data['role_id']);
            return ['status' => 'Пользователь добавлен'];
        } else {
            return ['error' => 'Не удалось добавить пользователя'];
        }
    }

    public function updateUser($request, $user)
    {
        if (Gate::denies('update', $user)) {
            abort(403);
        }

        $data = $request->all();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->fill($data)->update();
        $user->roles()->sync([$data['role_id']]);

        return ['status' => 'Пользователь изменен'];
    }

    public function destroyUser($user)
    {
        if (Gate::denies('delete', $user)) {
            abort(403);
        }

        $user->roles()->detach();

        if ($user->delete()) {
            return ['status' => 'Пользователь удален'];
        }
    }
}
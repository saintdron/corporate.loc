<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Repositories\PermissionRepository;
use Corp\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionController extends AdminController
{
    protected $per_rep;
    protected $rol_rep;

    public function __construct(PermissionRepository $per_rep, RoleRepository $rol_rep)
    {
        parent::__construct();

        $this->per_rep = $per_rep;
        $this->rol_rep = $rol_rep;
        $this->template = 'admin.permissions';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('EDIT_USERS')) {
            abort(403);
        }

        $this->title = "Управление правами";

        $roles = $this->getRoles();
        $permissions = $this->getPermissions();
        $this->content_view = view(env('THEME') . '.admin.permissions_content')
            ->with(['roles' => $roles, 'permissions' => $permissions])
            ->render();

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getRoles()
    {
        return $this->rol_rep->get(['id', 'name']);
    }

    public function getPermissions()
    {
        return $this->per_rep->get(['id', 'name']);
    }
}

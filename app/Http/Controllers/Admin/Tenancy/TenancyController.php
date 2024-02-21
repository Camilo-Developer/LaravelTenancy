<?php

namespace App\Http\Controllers\Admin\Tenancy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tenancy\TenancyCreateRequest;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Stancl\Tenancy\Database\Models\Domain;

class TenancyController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.tenancies.index')->only('index');
        $this->middleware('can:admin.tenancies.edit')->only('edit', 'update');
        $this->middleware('can:admin.tenancies.create')->only('create', 'store');
        $this->middleware('can:admin.tenancies.destroy')->only('destroy');
    }

    public function index()
    {
        $tenants = Tenant::all();
        $domains = Domain::all();
        return view('admin.tenancies.index',compact('domains','tenants'));
    }

    public function create()
    {
        //
    }

    public function store(TenancyCreateRequest $request)
    {
        //$tenant = Tenant::create($request->validated());
        $tenant = Tenant::create([
            'id' => $request->domain,
            'company' => $request->company,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $domainAll = $request->domain . '.' . config('tenancy.central_domains')[1];
        $tenant->createDomain(['domain' => $domainAll]);


        return redirect()->back();
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrganizationRequest;
use App\Models\Checkout;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\User;
use App\Repositories\CategoryRepository;
use App\Repositories\CountryRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\UserRepository;
use Brian2694\Toastr\Facades\Toastr;
use Exception;

class OrganizationController extends Controller
{
    protected $organization;

    protected $country;

    protected $category;

    public function __construct(OrganizationRepository $organization, CountryRepository $country, CategoryRepository $category)
    {
        $this->organization = $organization;
        $this->country      = $country;
        $this->category     = $category;
    }

    public function show($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $organization = $this->organization->find($id); //total student number for this organizaion

            $data         = [
                'organization'     => $organization,
                'total_student'    => User::whereHas('checkout', function ($query) use ($id) {
                    $query->whereHas('enrolls', function ($query) use ($id) {
                        $query->whereHasMorph('enrollable', [Course::class], function ($query) use ($id) {
                            $query->where('organization_id', $id);
                        });
                    });
                })->count(),
                'total_enrolls'    => Enroll::whereHasMorph('enrollable', [Course::class], function ($query) use ($id) {
                    $query->where('organization_id', $id);
                })->count(),
                'total_course'     => $organization->courses()->count(),
                'total_instructor' => $organization->instructors()->count(),
            ];

            return view('backend.organization.organization.details-organization', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $countries    = $this->country->all();
            $organization = $this->organization->find($id);
            $data         = [
                'countries'    => $countries,
                'organization' => $organization,
            ];

            return view('backend.organization.organization.edit-organization', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function update(OrganizationRequest $request, $id, UserRepository $userRepository)
    {
        if (config('app.demo_mode')) {
            Toastr::info(__('this_function_is_disabled_in_demo_server'));

            return back();
        }
        try {
            if (! hasPermission('organizations.edit')) {
                Toastr::error(__('permission_not_allowed'));

                return back();
            }

            $this->organization->update($request->all(), authOrganizationId());
            Toastr::success(__('update_successful'));

            return back();
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back()->withInput();
        }
    }

    public function overview($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $organization = $this->organization->find($id);

            $data         = [
                'organization'     => $organization,
                'total_earning'    => Checkout::whereHas('enrolls', function ($query) use ($id) {
                    $query->whereHasMorph('enrollable', [Course::class], function ($query) use ($id) {
                        $query->where('organization_id', $id);
                    });
                })->sum('payable_amount'),
                'total_course'     => $organization->courses()->count(),
                'total_instructor' => $organization->instructors()->count(),
                'total_student'    => User::whereHas('checkout', function ($query) use ($id) {
                    $query->whereHas('enrolls', function ($query) use ($id) {
                        $query->whereHasMorph('enrollable', [Course::class], function ($query) use ($id) {
                            $query->where('organization_id', $id);
                        });
                    });
                })->count(),
                'total_enrolls'    => Enroll::whereHasMorph('enrollable', [Course::class], function ($query) use ($id) {
                    $query->where('organization_id', $id);
                })->count(),
            ];

            return view('backend.organization.organization.overview', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function settings(UserRepository $userRepository)
    {
        try {
            $countries    = $this->country->all();

            $organization = $this->organization->find(authOrganizationId());
            $data         = [
                'countries'    => $countries,
                'organization' => $organization,
            ];

            return view('backend.organization.organization.setting', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }
}

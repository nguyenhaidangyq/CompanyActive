<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    public function manageDepartments() {
        $departments = Department::withCount("Staff")->paginate(20);
        return view("admin.department.departments", [
            "departments" => $departments
        ]);
    }

    public function departmentDetails($department_id) {
        $department = Department::withCount("Staff")->where("department_id", $department_id)->first();
        $staffs = Staff::with("Department")->where("department_id",$department_id )->paginate(10);
        return view("admin.department.department_details", [
            "department" => $department,
            "staffs" => $staffs,
            "edit" => false
        ]);
    }

    public function departmentEdit($department_id) {
        $department = Department::withCount("Staff")->where("department_id", $department_id)->first();
        $staffs = Staff::with("Department")->where("department_id",$department_id )->paginate(10);
        return view("admin.department.department_details", [
            "department" => $department,
            "staffs" => $staffs,
            "edit" => true
        ]);
    }

    public function departmentUpdate(Request $request, $department_id) {
        $data = array();
        $data["department_name"] = $request->get("department_name");
        $data["department_code"] = $request->get("department_code");
        $data["department_pic"] = $request->get("department_pic");
        $data["department_desc"] = $request->get("department_desc");
        $get_department = Department::findOrFail($department_id);
        $get_department->update($data);
        Session::put("message", "Update information department success !!");
        return Redirect::to("/admin/department-details/".$department_id);

    }

    public function departmentRemoveMember($staff_id) {
        try {
            $staff = Staff::findOrFail($staff_id);
            $department_id = $staff->department_id;
            $staff->update([
                "department_id" => null
            ]);
            Session::put("message", "Remove member from department success ");
            return Redirect::to("/admin/department-details/".$department_id);

        }catch (\Exception $e) {
            abort(404);
        }
    }

    public function departmentAddMember($department_id) {
        $staffs = Staff::all()->where("department_id", "=", "");
        return view("admin.department.staffs_list", [
            "staffs" => $staffs,
            "department_id" => $department_id
        ]);
    }

    public function departmentUpdateMember($department_id, $staff_id) {
        try {
            $staff = Staff::findOrFail($staff_id);
            $staff->update([
                "department_id" => $department_id
            ]);
            Session::put("message", "Add new member to department success !!");
            return Redirect::to("/admin/department-details/".$department_id);
        }catch (\Exception $e) {
            abort(404);
        }

    }

    public function addNewDepartment() {
        $pics = Staff::all();
        return view("admin.department.add_new_department", [
            "pics" => $pics
        ]);
    }

    public function saveNewDepartment(Request $request) {
        $request->validate([
           "department_name" => "required",
           "department_code" => "required",
        ], [
            "department_name.required" => "Department Name does not empty",
            "department_code.required" => "Department Code does not empty",
        ]);

        $data = array();
        $data["department_name"] = $request->get("department_name");
        $data["department_code"] = $request->get("department_code");
        $data["department_pic"] = $request->get("department_pic");
        $data["department_desc"] = $request->get("department_desc");
        try {
            Department::create($data);
            Session::put("message_success", "Add new department success !!");
            return Redirect::to("admin/manage-departments");
        }catch (\Exception $exception) {
            dd($exception->getMessage());
        }

    }

    public function deleteDepartment($department_id) {
        try {
            $department = Department::findOrFail($department_id);
            if($department->staff_count == 0) {
                $department->delete();
                Session::put("message_success", "Delete department ".$department->department_name. " success !!");
                Session::put("department_delete", $department);
                return Redirect::to("admin/manage-departments");
            }
        }catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function restoreDepartment($department_id) {
        try {
            $department = Department::withTrashed()->find($department_id);
            $department->restore();
            Session::put("message_success", "Restore department ".$department->department_name." success !!");
            return Redirect::to("admin/manage-departments");

        }catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
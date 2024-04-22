<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    // get data
    public function index()
    {
        $students = Student::all();

        if ($students->count() > 0) {
            return response()->json([
                'status' => 200,
                'students' => $students

            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Record Found',

            ], 404);
        }
    }

    // store data
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 404);
        } else {
            $student = new Student;
            $student->name = $request->name;
            $student->save();

            if ($student) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Student Created Successfully!',

                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong!',

                ], 500);
            }
        }
    }


    // show data
    public function show($id)
    {
        $student = Student::find($id);
        if ($student) {
            return response()->json([
                'status' => 200,
                'student' => $student

            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Student Found!'
            ], 404);
        }
    }

    // edit data
    public function edit($id)
    {
        $student = Student::find($id);
        if ($student) {
            return response()->json([
                'status' => 200,
                'student' => $student

            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Student Found!'
            ], 404);
        }
    }


    // update data
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 404);
        } else {
            $student = Student::find($id);
            $student->name = $request->name;
            $student->update();

            if ($student) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Student Updated Successfully!',

                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Something went wrong!',

                ], 404);
            }
        }
    }

    // delete data
    public function delete($id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Student Deleted Successfully!',

            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Student Found!'
            ], 404);
        }
    }
}

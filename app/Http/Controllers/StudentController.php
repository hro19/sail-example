<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all(); // Student モデルから全データを取得
        return view('students.index', compact('students')); // ビューにデータを渡して返す
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. リクエストデータのバリデーション
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students', // unique:students で students テーブル内で email が一意であることを確認
            // 他の属性のバリデーションルールも必要に応じて追加
        ]);
    
        // 2. 学生の作成と保存
        Student::create($validatedData);
    
        // 3. 作成完了後のリダイレクト
        return redirect()->route('students.index')->with('success', '学生が作成されました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        // $student には、指定された ID の Student モデルインスタンスが自動的に注入されます。
        // もし存在しない ID が指定された場合は、404 エラーが自動的に返されます。
    
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        // 1. リクエストデータのバリデーション
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students,email,' . $student->id,
            // 他の属性のバリデーションルールも必要に応じて追加
        ]);
    
        // 2. 学生情報の更新
        $student->update($validatedData);
    
        // 3. 更新完了後のリダイレクト
        return redirect()->route('students.index')->with('success', '学生情報が更新されました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete(); // 指定された学生を削除
    
        return redirect()->route('students.index')->with('success', '学生が削除されました');
    }
}

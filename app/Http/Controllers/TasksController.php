<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::all(); // タスク一覧を取得
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        $task = new Task; // 新しいタスクモデルのインスタンスを作成
        return view('tasks.create', ['task' => $task]);
    }

    public function store(Request $request)
    {
    // バリデーションルールとエラーメッセージの定義
    $request->validate([
        'title' => 'required',
        'content' => 'required',
        'status' => 'required|max:10', // statusに対するバリデーションを追加
    ], [
        'title.required' => 'タイトルを入力してください。',
        'content.required' => '内容を入力してください。',
        'status.required' => 'ステータスを入力してください。',
        'status.max' => 'ステータスは10文字以内で入力してください。', // statusの文字数制限に関するエラーメッセージ
    ]);

    // タスク作成処理
    $task = new Task;
    $task->title = $request->title;
    $task->content = $request->content;
    $task->status = $request->status;
    $task->save();

    // タスク一覧ページにリダイレクト
    return redirect()->route('tasks.index');
    }


    public function show($id)
    {
        $task = Task::findOrFail($id); // 指定されたIDのタスクを取得
        return view('tasks.show', ['task' => $task]);
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id); // 指定されたIDのタスクを取得
        return view('tasks.edit', ['task' => $task]);
    }

    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:255',
        ]);

        $task = Task::findOrFail($id); // 指定されたIDのタスクを取得
        $task->title = $request->title;
        $task->content = $request->content;
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id); // 指定されたIDのタスクを取得して削除
        $task->delete();

        return redirect()->route('tasks.index');
    }
}

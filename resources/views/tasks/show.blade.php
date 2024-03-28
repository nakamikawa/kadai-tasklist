@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>id = {{ $task->id }} のタスク詳細ページ</h2>
    </div>

    @if ($errors->any()) <!-- エラーメッセージがあれば表示 -->
        <div class="alert alert-error mb-4">
            <div>
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span><br>
                @endforeach
            </div>
        </div>
    @endif

    <table class="table w-full my-4">
        <tr>
            <th>id</th>
            <td>{{ $task->id }}</td>
        </tr>
        <tr>
            <th>タイトル</th>
            <td>{{ $task->title }}</td>
        </tr>
        <tr>
            <th>内容</th>
            <td>{{ $task->content }}</td>
        </tr>
        <tr>
            <th>ステータス</th>
            <td>{{ $task->status }}</td>
        </tr>
    </table>

    {{-- タスク編集ページへのリンク --}}
    <a class="btn btn-outline" href="{{ route('tasks.edit', $task->id) }}">このタスクを編集</a>

    {{-- タスク削除フォーム --}}
    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="my-2">
        @csrf
        @method('DELETE')
        
        <button type="submit" class="btn btn-error btn-outline" 
            onclick="return confirm('id = {{ $task->id }} のタスクを削除します。よろしいですか？')">削除</button>
    </form>

@endsection

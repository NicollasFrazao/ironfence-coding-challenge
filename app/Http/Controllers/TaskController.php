<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the resource index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('tasks.dashboard');
    }

    /**
     * Show the resource dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('tasks.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $user = $request->user();
        $input = $request->validated();

        try
        {
            \DB::beginTransaction();
            $user->tasks()->create($input);
            \DB::commit();

            \Flash::success('Tarefa criada com sucesso!');
            return redirect()->route('tasks.index');
        }
        catch (\Exception $error)
        {
            \Flash::error('Ocorreu um erro ao criar a tarefa! Erro: '.$error->getMessage());
            return redirect()->back();
        }
    }
}

<?php

// app/Http/Controllers/DuskController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DuskController extends Controller
{
    public function runDuskTest()
    {
        $process = new Process(['php', 'artisan', 'dusk']);
        $process->run();

        // Verifica se ocorreu algum erro ao executar o teste
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Retorna a saída do processo
        return back()->with('status', 'Teste Dusk executado com sucesso!');
    }
}

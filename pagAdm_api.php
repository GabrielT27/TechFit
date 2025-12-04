<?php
// Simple JSON-backed API for pagAdm (no DB required)
header('Content-Type: application/json; charset=utf-8');

$file = __DIR__ . '/alunos.json';

// Ensure file exists
if (!file_exists($file)) {
    file_put_contents($file, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function read_data($file) {
    $json = @file_get_contents($file);
    $data = json_decode($json, true);
    if (!is_array($data)) $data = [];
    return $data;
}

function write_data($file, $data) {
    // atomic write
    $tmp = $file . '.tmp';
    file_put_contents($tmp, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    rename($tmp, $file);
}

$method = $_SERVER['REQUEST_METHOD'];
$query = $_GET;
$input = json_decode(file_get_contents('php://input'), true) ?: [];

try {
    if ($method === 'GET') {
        $alunos = read_data($file);
        echo json_encode(['success' => true, 'data' => $alunos]);
        exit;
    }

    if ($method === 'POST') {
        // create new aluno
        $alunos = read_data($file);
        $aluno = $input;
        if (empty($aluno['id'])) {
            $aluno['id'] = 'ID-' . uniqid();
        }
        if (empty($aluno['dataCadastro'])) {
            $aluno['dataCadastro'] = date(DATE_ATOM);
        }
        $alunos[] = $aluno;
        write_data($file, $alunos);
        echo json_encode(['success' => true, 'data' => $aluno]);
        exit;
    }

    if ($method === 'PUT') {
        // update by id (id can be in query or body)
        $id = $query['id'] ?? ($input['id'] ?? null);
        if (!$id) throw new Exception('ID necessário para atualização');
        $alunos = read_data($file);
        $found = false;
        foreach ($alunos as $i => $a) {
            if (($a['id'] ?? '') === $id) {
                // preserve original dataCadastro if not provided
                $input['dataCadastro'] = $a['dataCadastro'] ?? ($input['dataCadastro'] ?? date(DATE_ATOM));
                $alunos[$i] = array_merge($a, $input);
                $found = true;
                break;
            }
        }
        if (!$found) throw new Exception('Aluno não encontrado');
        write_data($file, $alunos);
        echo json_encode(['success' => true, 'data' => $input]);
        exit;
    }

    if ($method === 'DELETE') {
        // delete by id (query or body)
        $id = $query['id'] ?? ($input['id'] ?? null);
        if (!$id) throw new Exception('ID necessário para exclusão');
        $alunos = read_data($file);
        $new = array_values(array_filter($alunos, function($a) use ($id) { return ($a['id'] ?? '') !== $id; }));
        write_data($file, $new);
        echo json_encode(['success' => true]);
        exit;
    }

    // method not allowed
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Método não permitido']);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

?>

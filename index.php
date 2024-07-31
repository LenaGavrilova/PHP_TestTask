<?php
require_once 'User.php';

header("Content-Type: application/json");

$user = new User();

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

if (json_last_error() !== JSON_ERROR_NONE && $method !== 'GET' && $method !== 'DELETE') {
    echo json_encode(['error' => 'Invalid JSON input', 'json_error' => json_last_error_msg()]);
    exit;
}

$path = isset($_SERVER['PATH_INFO']) ? explode('/', trim($_SERVER['PATH_INFO'], '/')) : explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));

switch ($method) {
    case 'POST':
        if (isset($path[0]) && $path[0] === 'register') {
            $result = $user->create($input);
            echo json_encode(['success' => $result]);
        } elseif (isset($path[0]) && $path[0] === 'login') {
        $result = $user->login($input['email'], $input['password']);
        echo json_encode(['user' => $result ? $result : 'Invalid credentials']);
    }
    break;

    case 'PUT':
        if (isset($path[1])) {
            $id = intval($path[1]);
            $result = $user->update($id, $input);
            echo json_encode(['success' => $result ? 'User updated successfully' : 'Failed to update user']);
        } else {
            echo json_encode(['error' => 'Invalid user ID']);
        }
        break;

    case 'DELETE':
        if (isset($path[1])) {
            $id = intval($path[1]);
            $result = $user->delete($id);
            echo json_encode(['success' => $result ? 'User deleted successfully' : 'Failed to delete user']);
        } else {
            echo json_encode(['error' => 'Invalid user ID']);
        }
        break;

    case 'GET':
        if (isset($path[1])) {
            $id = intval($path[1]);
            $result = $user->get($id);
            echo json_encode(['user' => $result]);
        } else {
            echo json_encode(['error' => 'Invalid user ID']);
        }
        break;

    default:
        echo json_encode(['error' => 'Invalid request']);
        break;
}
?>


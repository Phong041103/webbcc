<?php
// Bật CORS để Frontend ở domain/port khác có thể gọi được API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// 1. Cấu hình Database
$host = "sql101.infinityfree.com";
$username = "if0_41336797";
$password = "I8vacAmrZq9Y";
$db_name = "if0_41336797_bcc";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $exception) {
    http_response_code(500);
    echo json_encode(["error" => "Lỗi kết nối cơ sở dữ liệu: " . $exception->getMessage()]);
    exit();
}

// 2. Lấy URL đường dẫn (Endpoint)
// Ví dụ url sẽ có dạng: /users hoặc /users/1
$request_uri = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
$uri_segments = explode('/', trim($request_uri, '/'));

$method = $_SERVER['REQUEST_METHOD'];

// 3. Xử lý logic API
if ($method === 'GET' && $uri_segments[0] === 'users') {
    
    // Trường hợp: BASE_API/users/1 (Lấy 1 user theo ID)
    if (isset($uri_segments[1]) && is_numeric($uri_segments[1])) {
        $id = $uri_segments[1];
        
        $stmt = $conn->prepare("SELECT id, name FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            http_response_code(200);
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Không tìm thấy người dùng có ID = $id"]);
        }
    } 
    // Trường hợp: BASE_API/users (Lấy tất cả users)
    else {
        $stmt = $conn->prepare("SELECT id, name FROM users");
        $stmt->execute();
        
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        http_response_code(200);
        echo json_encode($users);
    }
} else {
    // Nếu truy cập sai endpoint
    http_response_code(404);
    echo json_encode(["message" => "Endpoint không hợp lệ. Vui lòng truy cập /users hoặc /users/{id}"]);
}
?>
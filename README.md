Тестовое задание для "Лаборатория Интернет" 

# User REST API

API поддерживает следующие методы:

POST /register - Создание нового пользователя
POST /login - Авторизация пользователя
PUT /user/{id} - Обновление информации пользователя
DELETE /user/{id} - Удаление пользователя
GET /user/{id} - Получение информации о пользователе

## Endpoints

### Create User
- **URL**: `/register`
- **Method**: `POST`
- **Data Params**: `{ "name": "Lena", "email": "lalla@example.com", "password": "password123" }`
- **Success Response**:
    - Code: `200`
    - Content: `{ "success": true }`


### Update User
- **URL**: `/user/{id}`
- **Method**: `PUT`
- **Data Params**: `{ "name": "Lena Gavrilova", "email": "opa@example.com" }`
- **Success Response**:
    - Code: `200`
    - Content: `{"success":"User updated successfully"}`
- **Error Response**:
  - Code: `400`
  - Content: `{"error":"Invalid user ID"}`

### Delete User
- **URL**: `/user/{id}`
- **Method**: `DELETE`
- **Success Response**:
    - Code: `200`
    - Content: `{"success":"User deleted successfully"}`
- **Error Response**:
  - Code: `400`
  - Content: `{"error":"Invalid user ID"}`

### Get User Info
- **URL**: `/user/{id}`
- **Method**: `GET`
- **Success Response**:
    - Code: `200`
    - Content: `{"user":{"id":3,"name":"Lena","email":"lalala@mail.ru","password":"$2y$10$3LE.\/xB7mqup1yJB9ITD2.CYhLjnQWUa9gmdlNthPWuGRD3c6acT2"}}`
- **Error Response**:
  - Code: `400`
  - Content: `{"error":"Invalid user ID"}`

### User Login
- **URL**: `/login`
- **Method**: `POST`
- **Data Params**: `{ "email": "opa@example.com", "password": "password123" }`
- **Success Response**:
    - Code: `200`
    - Content: `{"user":{"id":3,"name":"Lena","email":"opa@example.com","password":"$2y$10$3LE.\/xB7mqup1yJB9ITD2.CYhLjnQWUa9gmdlNthPWuGRD3c6acT2"}}`
- **Error Response**:
    - Code: `400`
    - Content: `{"user":"Invalid credentials"}`


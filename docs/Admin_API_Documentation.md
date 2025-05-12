# Admin API Documentation

## Base URL
The base URL for the Admin API is: `https://livreeo.webtrix.ma/api/admin`

---

## Authentication

### POST /auth/login
- Description: Authenticates an admin user.
- Body: JSON object with `email` and `password`.
- Example:
```json
{
  "email": "admin@example.com",
  "password": "yourpassword"
}
```

### GET /auth/me
- Description: Retrieves information about the currently authenticated admin user.

### POST /auth/logout
- Description: Logs out the currently authenticated admin user.

---

## Cities (Admin)

### GET /cities
- Description: Retrieves all cities for admin use.
- Query Parameters:
  - `keyword` (optional): Keyword for filtering cities.

### POST /cities
- Description: Creates a new city.
- Body: JSON object with the name of the city.
- Example:
```json
{
  "name": "Casablanca"
}
```

### PUT /cities/{id}
- Description: Updates an existing city.
- Path Parameters:
  - `id`: ID of the city to update.
- Body: JSON object with updated city data.

### DELETE /cities/{id}
- Description: Deletes a city.
- Path Parameters:
  - `id`: ID of the city to delete.

---

## Schools (Admin)

### GET /schools
- Description: Retrieves all schools for admin use.
- Query Parameters:
  - `keyword` (optional): Keyword for filtering schools.

### POST /schools
- Description: Creates a new school.
- Body: JSON object with school data.

### PUT /schools/{id}
- Description: Updates an existing school.
- Path Parameters:
  - `id`: ID of the school to update.
- Body: JSON object with updated school data.

### DELETE /schools/{id}
- Description: Deletes a school.
- Path Parameters:
  - `id`: ID of the school to delete.

---

## Classes (Admin)

### GET /classes
- Description: Retrieves all classes for admin use.
- Query Parameters:
  - `keyword` (optional): Keyword for filtering classes.

### POST /classes
- Description: Creates a new class.
- Body: JSON object with class data.

### PUT /classes/{id}
- Description: Updates an existing class.
- Path Parameters:
  - `id`: ID of the class to update.
- Body: JSON object with updated class data.

### DELETE /classes/{id}
- Description: Deletes a class.
- Path Parameters:
  - `id`: ID of the class to delete.

### POST /classes/{id}/toggle-status
- Description: Toggles the status of a class.
- Path Parameters:
  - `id`: ID of the class.

---

## Books (Admin)

### GET /books
- Description: Retrieves all books for admin use.
- Query Parameters:
  - `keyword` (optional): Keyword for filtering books.

### POST /books
- Description: Creates a new book.
- Body: JSON object with book data.

### PUT /books/{id}
- Description: Updates an existing book.
- Path Parameters:
  - `id`: ID of the book to update.
- Body: JSON object with updated book data.

### DELETE /books/{id}
- Description: Deletes a book.
- Path Parameters:
  - `id`: ID of the book to delete.

---

## Promo Codes (Admin)

### GET /promo-codes
- Description: Retrieves all promo codes for admin use.

### POST /promo-codes
- Description: Creates a new promo code.
- Body: JSON object with promo code data.

### GET /promo-codes/{id}
- Description: Retrieves a promo code by ID.
- Path Parameters:
  - `id`: ID of the promo code.

### PUT /promo-codes/{id}
- Description: Updates an existing promo code.
- Path Parameters:
  - `id`: ID of the promo code.
- Body: JSON object with updated promo code data.

### DELETE /promo-codes/{id}
- Description: Deletes a promo code.
- Path Parameters:
  - `id`: ID of the promo code.

### POST /promo-codes/{id}/toggle-status
- Description: Toggles the status of a promo code.
- Path Parameters:
  - `id`: ID of the promo code.

### POST /promo-codes/verify
- Description: Verifies a promo code.
- Body: JSON object with `code`.

---

## Orders (Admin)

### GET /orders
- Description: Retrieves all orders for admin use.
- Query Parameters:
  - `page` (optional): Page number for pagination.

### GET /orders/{id}
- Description: Retrieves order details by ID.
- Path Parameters:
  - `id`: ID of the order.

### PUT /orders/{id}
- Description: Updates order status.
- Path Parameters:
  - `id`: ID of the order.
- Body: JSON object with `status`.

### DELETE /orders/{id}
- Description: Deletes an order.
- Path Parameters:
  - `id`: ID of the order.

---

# Notes
- All endpoints require authentication via admin auth.
- Use JSON format for request and response bodies.
- Replace `{id}` with the actual resource ID.
- Use appropriate HTTP methods as specified.

## Location Management System API (lms)

This documentation describes how to use the Location Management System API (lms). This API supports adding, listing, viewing details, updating, deleting locations and listing shortest routes.
 
## API Endpoints

Listed below are the endpoints and uses of the API:

### 1. Add Location

-  **Endpoint:** `/api/locations`
-  **Method:** `POST`
-  **Data Params:**
 ```json
{
	"name": "Ankara",
	"latitude": 39.92077,
	"longitude": 32.85411,
	"color": "#FF5733"
}
  ```

-   **Success Response:**
    -   **Code:** 201
    -   **Content:**
        
```json
{
  "id": 1,
  "name": "Ankara",
  "latitude": 39.92077,
  "longitude": 32.85411,
  "color": "#FF5733",
  "created_at": "2021-01-01T00:00:00.000000Z",
  "updated_at": "2021-01-01T00:00:00.000000Z"
}
```

### 2. List Locations

-   **Endpoint:** `/api/locations`
-   **Method:** `GET`
-   **Success Response:**
    -   **Code:** 200
    -   **Content:**
        
``` json
[
	{
	    "id": 1,
	    "name": "Ankara",
	    "latitude": "39.92077000",
	    "longitude": "32.85411000",
	    "color": "#FF5733",
	    "created_at": "2024-05-23T09:52:10.000000Z",
	    "updated_at": "2024-05-23T09:52:10.000000Z"
	},
	{
	    "id": 2,
	    "name": "İstanbul",
	    "latitude": "41.00485000",
	    "longitude": "28.68252000",
	    "color": "#33C4FF",
	    "created_at": "2024-05-23T09:52:10.000000Z",
	    "updated_at": "2024-05-23T09:52:10.000000Z"
	},
	{
	    "id": 3,
	    "name": "Yozgat",
	    "latitude": "39.81521000",
	    "longitude": "34.77095000",
	    "color": "#8E44AD",
	    "created_at": "2024-05-23T09:52:10.000000Z",
	    "updated_at": "2024-05-23T09:52:10.000000Z"
	},
	{
	    "id": 4,
	    "name": "Edirne",
	    "latitude": "41.66886000",
	    "longitude": "26.53212000",
	    "color": "#2ECC71",
	    "created_at": "2024-05-23T09:52:10.000000Z",
	    "updated_at": "2024-05-23T09:52:10.000000Z"
	},
	{
	    "id": 5,
	    "name": "Bingöl",
	    "latitude": "38.88318000",
	    "longitude": "40.48024000",
	    "color": "#F39C12",
	    "created_at": "2024-05-23T09:52:10.000000Z",
	    "updated_at": "2024-05-23T09:52:10.000000Z"
	},
	{
	    "id": 6,
	    "name": "Hakkari",
	    "latitude": "37.57427000",
	    "longitude": "43.71419000",
	    "color": "#3498DB",
	    "created_at": "2024-05-23T09:52:10.000000Z",
	    "updated_at": "2024-05-23T09:52:10.000000Z"
	}
]
```        

### 3. Location Detail

-   **Endpoint:** `/api/locations/{id}`
-   **Method:** `GET`
-   **Success Response:**
    -   **Code:** 200
    -   **Content:**
        
```json
{
	"id": 1,
    "name": "Ankara",
    "latitude": "39.92077000",
    "longitude": "32.85411000",
    "color": "#FF5733",
    "created_at": "2024-05-23T09:52:10.000000Z",
    "updated_at": "2024-05-23T09:52:10.000000Z"
}
```

### 4. Edit Location

-   **Endpoint:** `/api/locations/{id}`
-   **Method:** `PUT`
-   **Data Params:**
    
```json  
{
    "name": "Updated Ankara",
    "latitude": "39.92077000",
    "longitude": "32.85411000",
    "color": "#FF5733",
}
```
    
-   **Success Response:**
    -   **Code:** 200
    -   **Content:**
        
```json      
{
	"id": 1,
	"name": "Updated Central Park",
	"latitude": 40.785091,
	"longitude": -73.968285,
	"color": "#000000"
}
```

### 5. Delete Location

-   **Endpoint:** `/api/locations/{id}`
-   **Method:** `DELETE`
-   **Success Response:**
    -   **Code:** 204
    -   **No Content**

### 6. List Shortest Routes

-   **Endpoint:** `/api/route/5`
-   **Method:** `GET`
-   **Success Response:**
    -   **Code:** 200
    -   **Content:**
        
``` json
[
    {
        "id": 5,
        "name": "Bingöl",
        "latitude": "38.88318000",
        "longitude": "40.48024000",
        "color": "#F39C12",
        "created_at": "2024-05-23T09:52:10.000000Z",
        "updated_at": "2024-05-23T09:52:10.000000Z"
    },
    {
        "id": 6,
        "name": "Hakkari",
        "latitude": "37.57427000",
        "longitude": "43.71419000",
        "color": "#3498DB",
        "created_at": "2024-05-23T09:52:10.000000Z",
        "updated_at": "2024-05-23T09:52:10.000000Z"
    },
    {
        "id": 3,
        "name": "Yozgat",
        "latitude": "39.81521000",
        "longitude": "34.77095000",
        "color": "#8E44AD",
        "created_at": "2024-05-23T09:52:10.000000Z",
        "updated_at": "2024-05-23T09:52:10.000000Z"
    },
    {
        "id": 1,
        "name": "Ankara",
        "latitude": "39.92077000",
        "longitude": "32.85411000",
        "color": "#FF5733",
        "created_at": "2024-05-23T09:52:10.000000Z",
        "updated_at": "2024-05-23T09:52:10.000000Z"
    },
    {
        "id": 2,
        "name": "İstanbul",
        "latitude": "41.00485000",
        "longitude": "28.68252000",
        "color": "#33C4FF",
        "created_at": "2024-05-23T09:52:10.000000Z",
        "updated_at": "2024-05-23T09:52:10.000000Z"
    },
    {
        "id": 4,
        "name": "Edirne",
        "latitude": "41.66886000",
        "longitude": "26.53212000",
        "color": "#2ECC71",
        "created_at": "2024-05-23T09:52:10.000000Z",
        "updated_at": "2024-05-23T09:52:10.000000Z"
    }
]
```   


## Errors and Status Codes

It uses the following HTTP status codes in error situations:

-   `201 Created`: When it results in one or more new resources being created
-   `204 No Content`: When the request has been successfully processed but there is no content to return.
-   `400 Bad Request`: When the submitted request is invalid or incomplete
-   `404 Not Found`: When the specified resource cannot be found
-   `500 Internal Server Error`: When an unexpected error occurs on the server side

## Security and Limitations

The API is limited to a maximum of 60 requests per user per minute. For security purposes, all data transfers must be made over HTTPS.
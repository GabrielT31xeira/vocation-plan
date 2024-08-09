# Hi

My name is Gabriel Teixeira de Carvalho, a mid-level software developer.

## About Me

I have a passion for software development and experience in various technologies and platforms. My primary focus is on producing clean, efficient code with special attention to software maintainability and scalability.

## Work Experience

I have experience in working on software development projects of various sizes, from small personal apps to large-scale enterprise solutions. I have created a number of successful solutions for the everyday challenges faced by organizations.

## Thanks to the Company

I am grateful for the opportunity to apply for this position in your company. I am excited about the possibility of contributing to your team and the continued success of your company.

![CR7 gif](https://media.tenor.com/277tHOZusxEAAAAC/siuuuuuu-ballon-dor.gif)

Thank you for the consideration!

Gabriel Teixeira de Carvalho

# About the application 

## API Endpoints Tutorial
Please note that except for `login` and `register`, all other routes require authorization. So make sure to include the token in the `Authorization` header of the request.

- **Login**: `POST /login`
  Use this route to authenticate a user.
    
    Request:
    ````
  {
    "email": "example3@email.com",
    "password": "examplepassword"
    }
  ````
  
    Response: 
    ````
  {
    "message": "User logged in successfully",
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5Y2JhNTk3NS1jMWIwLTQ2OWUtOTcyMi03NDRkYmY5ZDJhY2QiLCJqdGkiOiJhYmRlYWNjMzI5MmU0OWFmNzgzODQzZjVkYWRjMDhhNjJlODE2Mzk2ZDY2MDQwMmVhOGU1YTBiNDFlZWUxMjBjNzU2ZTNhNzQ1ZTQxYmQxOSIsImlhdCI6MTcyMzI0MTgxNi43MzYxNDEsIm5iZiI6MTcyMzI0MTgxNi43MzYxNDMsImV4cCI6MTczOTEzOTQxNi43MTE2NDYsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.llg7h7mFJFCkCBsNo0-YytuTOjLCOvAsF6QEou6AkOEVR9dgQLSUISZgXz52RtJR7HRdG4pO7ytsXwcd6_z_7MBmqwpeqZqe7uFp5_OIf6MzY92c6uRz3PxDei99b0gHEX3-qk12YNjcaAo6eXE4TcyRJEgXFvbjybFMUx2d1P1RPHhjv2-xdgS7sfevCfrYoQy2xop-VJ13JgkV1h-wf120ggfF2Wu_EBYfiag96twLynh3TbBMiiX3DUXIVJvQfuNimOM3V8P7xUeAfNoC8cG1ffn0Na3fBZPHZZax10lFy_TFQ2GrRLKbmXGqXt7JS1LgT57hjH8I_2-kcaimnIeknHHZs0qEgNlv04nvkDL7NgdMVWCJ7F-d7YWC78JlqESVItSI2t8iWaXpK1s6sNtBh2jR4Ro7yiYKUx9-VUcsHevcmdHWzY8aJmaZPNVL7I6LMK7SyPoe905RdCxg-mC1CArYH6KS1BZwNFw57-UhGxcLKoTHOIfIoui-awA3r7C02nt2JhQm7DeEKrVdECtBdlQGxKBmVIsJuzzDf9BP7Y-IP0bu3yZLgdyZ3L8nvYx0v43JxH76A87SpgxQaAggYrjM8vqLRj1ezMf_K11C22BA1j9R3BgabvC63Fo8ecEhQ1IgyWraiYrnr-L1a3pRpNuKgsNX3Xzobwqa0NI"
}


- **Register**: `POST /register`
  This route is for creating new user accounts.

  Request:
    ````
  {
    "name": "example 3",
    "email": "example3@email.com",
    "password": "examplepassword"
    }
    ````
  Response: 

    ````
  {
    "message": "User created successfully",
    "user": {
        "name": "example 3",
        "email": "example32@email.com",
        "updated_at": "2024-08-09T21:35:33.000000Z",
        "created_at": "2024-08-09T21:35:33.000000Z",
        "id": 2
    }
  }
  ````
    
    
- **Logout**: `POST /logout`
  Use this endpoint to invalidate current user authentication.
    
    Response:
    ````
    "message": "User logout successfully."
    ````
  - **Profile**: `GET /profile`
    This route will return the profile data for the currently authenticated user.

      Response:
      
  ````
      {
      "user": {
          "id": 1,
          "name": "example 1",
          "email": "example1@email.com",
          "email_verified_at": null,
          "created_at": "2024-08-09T22:16:51.000000Z",
          "updated_at": "2024-08-09T22:16:51.000000Z"
            }
      }
  ````
    - **Holidays Plan CRUD Operations**:

        - `GET /holiday` get all holidays
        - `GET /holiday/{id}` get one
        - `POST /holiday` to create a new holiday
          
          Request: 
            ````
          {
          "title": "Example 1",
          "description": "Description 1",
          "date": "2024-12-31",
          "location": "locate 1"
          }

        - `PUT /holiday/{id}` to update a holiday
          Request:
            ````
          {
          "title": "Example update",
          "description": "Description update",
          "date": "2024-12-31",
          "location": "locate update"
          }
        - `DELETE /holiday/{id}` to delete a holiday
          Please replace `{id}` with the actual holiday ID.

- **Holiday PDF generator**: `GET /holiday/{id}/pdf`
  This endpoint will generate a PDF of the Holiday information.

  - **Participant Related Operations**:

      - `PATCH /holiday/{id}/participants/related` to relate participants to a holiday
        
        Request: 
         ````{
        {
            "ids": [
                "2",
                "3"
            ]
        }
      - `PATCH /holiday/{id}/participants/unrelated` to unrelate participants from a holiday
        Please replace `{id}` with the actual holiday ID.

        Request:
         ````{
        {
            "ids": [
                "2",
                "3"
            ]
        }

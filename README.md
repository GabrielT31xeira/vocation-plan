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
- **Profile**: `GET /profile`
  This route will return the profile data for the currently authenticated user.

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

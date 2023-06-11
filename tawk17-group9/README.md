# tawk17-group9

The Workout Tracker Application is designed to help users track their workout sessions. With this application, users can create, retrieve, update, and delete (CRUD) different workout sessions, recording details such as activity, duration, and time intervals.
The application distinguishes between two types of users: regular users and admin users. Regular users are individuals who want to track and add their workout sessions, while admin users are personal trainers who have additional access and capabilities. Admin users can view and access the activities of regular users, providing guidance and monitoring their progress.


## Installation

Clone the repository: git clone <tawk17-group9>
Install dependencies: Make sure you have MySQL installed.
Configure the application by setting up the database and environment variables.
Start the MySQL server: Launch your MySQL server(e.g., mySQLWORKbench) and ensure it is running.
Start the application server: MAMP
Access the application: Once the server is running, you can access the application by opening a web browser and entering the appropriate URL.


## Usage

Access the application in your web browser.
Sign up or log in with your user account.
Explore the features to manage workout sessions, see the times and the date of the workouts
Admin users have additional capabilities to manage users and their activities, they can CRUD and see all the users information.

## API Integration

The Workout Time Tracker Application integrates with external APIs to enhance functionality. External API/Service We will use TimeAPI.io to show the current time in different time zones, this way the user can track their times. https://timeapi.io/swagger/index.html


## User Roles

Regular Users: Can track and add workout sessions,View their own activities,
Admin Users: Have enhanced capabilities,Can manage users and CRUD their activities.

## File Structure

- api
  - APIRoot.php
  - APIRouter.php
  - AuthAPI.php
  - ExerciseAPI.php
  - RestAPI.php
  
- business-logic
  - AuthService.php
  - ExerciseExternalService.php
  - ExerciseService.php
  - UsersService.php
  
 
- data-access
  - Database.php
  - ExerciseDatabase.php
  - UsersDatabase.php
  

- exerciseexternal-data-access
  - ExerciseExternalFetcher.php
- frontend
  - assets
    - css
    - img
    - js
    - mime.csv

  - controllers
      - ArticleController.php
      - AssetsController.php
      - AuthController.php
      - ExerciseController.php
      - ExerciseExternalController.php
      - HomeController.php
   
- views
  - auth
    - login.php
    - profile.php
    - register.php
    - unauthorized.php

  - exerciseexternal
    - home.php

  - exercises
    - edit.php
    - index.php
    - new.php
    - single.php

  - articles.php
  - home.php
  - notFound.php

 - ControllerBase.php
 - FrontendRouter.php
 - functions.php
 - Templates.php

- models
 - ExerciseModel.php
 - UserModel.php

- config.pgp
- index.php
- README.md


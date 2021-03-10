
- Author: omokpo Gabriel

# About Jobboard Api

Jobboard api is a Tedbree Backend Developer Assessment designed with php that enables companies to post jobs as well as applicates to apply for jobs posted by these companies.
- language: Php
- DBMS: postgresql
- Auth: jwt-auth


## Installation procedure

 - git pull this repo
 - run composer install
 - setup the .env file as appropriate
 - run
    - php artisan migrate
    - php artisan db:seed --force
    -  php artisan jwt:secret
    - php artisan storage:link
    
    
<i>Please reach out to me if you have any issues setting up this project</i>

## The api endpoints are:

 - Registration endpoint  [POST] - http://127.0.0.1:8000/api/v1/register
    - {
        - "name": "omokpo gabriel",
        - "password" :"password",
        - "email" : "business@example.com",
        - "role" : "business"  (This is optionals)
    -  }
     
       
 - Login endpoint [GET] - http://127.0.0.1:8000/api/v1/login
     - {
         - "email" : "business@example.com",
         - "password" :"password"
        
     -  }

  - Logout endpoint [POST] - http://127.0.0.1:8000/api/v1/logout
 - Get list of user jobs [GET] - http://127.0.0.1:8000/api/v1/my/jobs
 -  Add a new job [POST] - http://127.0.0.1:8000/api/v1/my/jobs
    -  {        
       - "title": "Frontend Developer Needed", 
        - "description" : "Description Frontend development",
        - "location" : "Lagos",
        - "category" : "Tech",
        - "benefits" : "Free Meal, and air plain",
        - "salary" : "N150,00 per Month",
        - "type" : "permanent",
        - "work_condition" : "Remote"
    - }
 
 - Delete a job post [DELETE] - http://127.0.0.1:8000/api/v1/my/jobs/{job_id}
 - Get all job posts [GET] - http://127.0.0.1:8000/api/v1/jobs
 - Search job post by title [GET] - http://127.0.0.1:8000/api/v1/my/jobs?q=frontend
 -  Update a job post title [PATCH] - http://127.0.0.1:8000/api/v1/my/jobs/{JOB_id}
     -  {
         - "title": "Backend Developer Needed urgently"
     - }
 
 - apply for a job [POST] - http://127.0.0.1:8000/api/v1/job/FJB-24165-FDN/apply
     -  {
         - "first_name": "Gabriel",
         - "last_name": "Omokpo",
         - "email": "omokpogabriel@gmail.com",
         - "phone": "0811111111",
         - "location": "Lagos",
         - "cv": "bestcv.pdf"
     - }
       <br/>
 - get a list of applicates for a job post [GET] - http://127.0.0.1:8000/api/v1/my/jobs/FJB-24165-FDN/applications

## Database
 - Database name: jobboard_db
 - Number of tables : 6
 - Relationships:
  -- OneToMany relationship between Job_posts and job_applicates_table  
  -- OneToMany relationship between user and Job_posts 
 

# Assumptions/Rational 

- The company and company logo in the job_post table where set because it wasn't specified whether user can post jobs belonging to other companies. an example could be a recruitment agencies. hense i didnt couple those fields with the values in users table even though they have oneToMany Relationship.
- In deleteJob(), The assumption is that a user can only delete a post he posted before. that is, you cannot delete another user's post.
- The User table has a role field with default value of business, the rational here is that we can have different users with difference roles <br/>
  such as admin, superadmin, etc.
- The accepted values of the job categories are those on the job_category table 
- The accepted values for work_condition are those in the work_condition table
- The accepted values for job types are those in the job type table

## Custom validate rules
- JobCategory::class check the job category to make sure they are those in the job category tables
- JobType::class check the job type to make sure they are those in the job type tables
- WorkConditionRules::class check the work condition to make sure they are those in the work_condition tables

## Middleware
- biz_user : ensure that the request is authenticated and has a role of "business"


## challenges
- had an error issue with Cygwin

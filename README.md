# REX Backend Test

## Overview 

The Good Forum (tm) is an API application built based on [Laravel 5.6](https://laravel.com/).
It was hastily built by some Junior developers, and it needs a little bit of love.
We would like you to help improve this application by completing the tasks outlined below.

This API will be utilised by a React frontend. 

![Mockup of Forum Messages](resources/assets/img/mockup-forum-messages.png)

### How to complete the test

* Fork this repository and add this repository as an upstream.
* Create branches or work on master (up to you).
* Complete the tasks as outlined below.
* Feel free to add any of your own improvements, be sure to identify them in your commit messages.
* Make sure you replace this README with your own, add any suggestions to developers for getting started (see final task).
* Submit a PR once you've completed your work.

We would appreciate you indicating which tasks you are addressing in your commits or PR messages.

Other hints: feel free to use community packages, you don't have to write everything yourself. Use the PHP ecosystem.

### Tasks

#### Task 1 - Add seeds

Currently our seeds are incomplete. This makes it hard to test the application and for our frontend team to work on the 
interface.  Please add seeds for the following models:

- Topics
- Messages

It would be great if there were some message seeds demonstrating the nested parent_id relationship that messages
within a topic can have.

#### Task 2 - Add authentication 

Our API currently does not have any authentication defined.  Please protect the following routes with an auth scheme 
that requires a valid API key.

- Protect all routes with an API key that identifies the `User`
- The route for creating a new user probably shouldn't require an API key since that will make it quite hard to register.

#### Task 3 - Refactor the thread controller

The controller  `App\Http\Controllers\Api\TopicThreadController` has been put together by one of our 
developers in a hurry.  This controller returns a nested list of messages for a particular topic but now it's time to 
refactor it into something more readable and maintainable.

* Write a test that shows that the current controller works
* Refactor controller for readability / performance / etc.
* Create any methods and/or classes you deem necessary
* Improve any logic
* Refine the test (if necessary)

#### Task 4 - Transform output

Our controller methods currently return our api output by just returning the model directly, but it's becoming a problem 
because every time we update our model properties we break what is expected from our API.  Also, we would like all our 
dates to be returned in UTC format.

* Change the methods in `Api\UserProfileController` and `Api\MessageController` to transform the output resources.
* Only return the resource fields necessary.
* Ensure all dates are output in UTC format.
* Write a test to ensure that it outputs what you expect it to.

Note there are packages available that can help you with this, or you can roll your own solution.

#### Task 5 - Add total messages to the Section and Topic endpoints

Those damn UI designers just sent us another update.  When listing the sections and topics they want to be able
to show the number of messages contained within:

- Extend the Section and Topic controllers to include a `total_messages` field in their output.

#### Task 6 - Add user avatars

Our UX team has made an update, and they'd like us to add avatars to `user` profiles so that the design 'pops'. 
Please implement the ability for our users to have a single OPTIONAL avatar image on their profile:

- Extend models and migrations, and seeds.
- Create appropriate methods or controllers.
- Write appropriate test to ensure that you can retrieve and update an avatar for a user.
- Would be good if the image storage was flexible enough to change to an s3 bucket in the future.
- Update any resource transformations so that the user profile includes the avatar URL (if an avatar is set).

#### Task 7 - Allow topic owners to highlight interesting messages

Topic owners want a way to be able to "highlight" interesting messages within the thread.

Update the appropriate endpoint to:

- Allow user that owns a topic should be able to "highlight a message" `is_highlight`

#### Task 8 - Add moderators

We'd like to empower some of our users to do all the heavy-lifting for us. In order to do this, we will need to be
able to set various users as moderators. 

The role of those users will be to:

- Approve new topics - by default new topics should now be not approved by default, and not show in any list until 
they are approved.
- Flag bad messages - add the ability to flag a bad message so it is no longer

#### Task 9 - Auto-approve new topics

Our forum is on fire, and now that topics require approval, we're worried that some moderators are a bit lazy and wont
be able to keep up with all the new topics.  

- Setup a command that can be added to our server cron that will auto-approve topics after 3 days if they have
not already been approved.

#### Task 10 - Fix the users endpoints

It looks like we've got a few role/security related issues we need you to clean up in the users endpoints.

- Only authorized users can update their own account.
- Only moderators can update other user's accounts.
- Only moderators can delete accounts.
- When you delete a user, all of that user's topics and messages should also be deleted, or flagged somehow.

#### Task 11 - Add a new endpoint which gives you all the messages for a topic

We already have a global endpoint for fetching messages, but we need to get them for a particular topic ID.

- Create a new endpoint which returns only messages for a given topic.
- Allow ordering by date, or alphabetically.

#### Task 12 - Add not null constraint

The `nickname` column in the `users` currently permits null values.  Unfortunately, we already have 50 users. Some of
them will have null values - and our and our forum is in production!

* Update the model(s)
* Add appropriate database migration(s)
* Handle migration of existing data through the appropriate means
* Update any data transformations for the resource

#### Task 13 - Add pagination to the messages controller

Wwoww, we're so popular right now. The list of messages returned from the GET `/api/v1/messages` endpoint is pretty
big. 

- Implement pagination on the messages controller.
- The response should include the pagination details for fetching the next page.

#### Task 14 - Fix the messages controller

Ok so there's a couple of big problems with the messages controller.

- The validation is pretty bad
- You shouldn't be able to link a message to a parent_id that doesn't share the same topic_id
- We need a test to ensure that all this is working

#### Task 15 - Document the messages controller

Our frontend dev's keep asking us how to use the API for `Api\MessageController`, but we don't have any documentation :(
In an ideal world, we would have documented all of our endpoints before we even began coding.
Help us by documenting this controller, including the available input.

* We like the OpenAPI 3.0 spec (swagger)
* You can use another spec/format but if so please explain the advantages.
* You only need to document the one controller.
* Put your documentation into the `docs/` folder

Don't worry about the other controllers for now.

#### Task 16 - Improve database indexes

Currently none of the database tables have any indexes defined. 

* Add indexes where appropriate (hint: sections, messages, topics)
* Explain how you measured the usefulness of these indexes
* Don't add indexes that wont be used though

#### Task 17 - Dockerize this application

We've been having some trouble reproducing some issues between staging and dev.  The developer of this application, has appropriately told support "Works for me", but we think there might be a better way:

* Dockerize this application
* Include instructions how to fire up your application

#### Task 18 - Write a new README

Now that you've completed the tasks, please replace this README with a suitable one for the project.
It should provide a good overview of your project, how it should be installed and configured for DEV and PROD and an explanation of anything that is currently incomplete. Perhaps some ideas for what could be improved in the future.

## Installation

### Requirements

- PHP 7.0
- Postgresql or MySQL

### Configure

```bash
cp .env.example .env
```

Edit the `.env` file to update database credentials

### Install dependencies

```bash
composer install
```

### Run tests

```bash
composer tests
```

### Run application

```bash
php artisan serve
```

Application available from: `http://localhost/`

### Access the API

The API is RESTful:

#### Sections

Sections contain topics. Each section breaks the forum up into logically grouped areas. Eg. the "Crypto" section.

- List of sections: `GET /api/v1/sections`
- Retrieve section: `GET /api/v1/sections/{id}`
- Create a new section: `POST /api/v1/sections`
- Update a section: `PATCH /api/v1/sections/{id}`
- Delete a section: `DELETE /api/v1/sections/{id}`

#### Topics

Topics group together messages within a section.  An example topic in the "Crypto" section might be "I just mortgaged 
my house and now BTC is only worth 3k :scream:".

- List of topics: `GET /api/v1/topics`
- Retrieve topic: `GET /api/v1/topics/{id}`
- Create a new topic: `POST /api/v1/topics`
- Update a topic: `PATCH /api/v1/topics/{id}`
- Delete a topic: `DELETE /api/v1/topics/{id}`
- Get topic thread: `GET /api/v1/topics/{id}/thread`

#### Messages

Messages are created within a topic and may have a parent_id for nested relationships.

- List of messages: `GET /api/v1/messages`
- Retrieve message: `GET /api/v1/messages/{id}`
- Create a new message: `POST /api/v1/messages`
- Update a message: `PATCH /api/v1/messages/{id}`
- Delete a message: `DELETE /api/v1/messages/{id}`

#### Users

Users are the entities within the system that can create messages, and topics.

- List of users: `GET /api/v1/users`
- Retrieve user: `GET /api/v1/users/{id}`
- Create/register a new user: `POST /api/v1/users`
- Update a user: `PATCH /api/v1/users/{id}`
- Delete a user: `DELETE /api/v1/users/{id}`
- Retrieve user profile: `GET /api/v1/users/{id}/profile`
- Update user profile: `PATCH /api/v1/users/{id}/profile`


## My Feedback

I decided to place all of my endpoints and testing references in a [Postman Collection](https://www.getpostman.com/collections/68332966cec58291ec14) for ease of use and to get broader access to the applications endpoints.

I allotted myself around 3 hours to get as much done in sequential order from the README.md that was provided whilst taking my time and thoroughly implementing logical solutions to the tasks at hand.

#### Task 1
- I was unsure on what the parent_id column referred to for the Message model, however after some investigation it became apparent that it was for threaded/nested messages
- Sections did not appear to need a seed however were asked to be implemented - correct me if I'm wrong about this

#### Task 2
- Authentication was fun and a breeze, snapping in JWT with the default Laravel user model is easy and fun
- Protecting routes was a task that had me questioning some practices that I considered (the different ways to apply middleware to different routes/controllers) however I went with a route group approach which seemed to encompass the application nicely

#### Task 3
- Writing tests for the TopicThreadController was a good way to see how future implementations of the logic behind the recursive functionality would change and take shape (super helpful test)
- I first thought about ways to go about re-writing the recursive functionality of the controller ("should I use a library perhaps?" was one of them) but instead decided to leverage Laravel's Eloquent relationships to nicely nest children models inside each other efficiently




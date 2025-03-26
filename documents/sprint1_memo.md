# Memo - sprint 1

<!-- TOC tocDepth:2..3 chapterDepth:2..6 -->

- [Memo - sprint 1](#memo---sprint-1)
  - [General](#general)
  - [User stories and acceptance criteria](#user-stories-and-acceptance-criteria)
    - [User story map](#user-story-map)
    - [Must have (high priority) - for this sprint](#must-have-high-priority---for-this-sprint)
      - [As an admin...](#as-an-admin)
        - [... I want to manage the reading challenges so that I can control the planned challenges](#-i-want-to-manage-the-reading-challenges-so-that-i-can-control-the-planned-challenges)
        - [... I want to manage the registered users so that I can control the user accounts](#-i-want-to-manage-the-registered-users-so-that-i-can-control-the-user-accounts)
        - [... I want to manage the reviews so that I can check if the reviews complies with the chart](#-i-want-to-manage-the-reviews-so-that-i-can-check-if-the-reviews-complies-with-the-chart)
        - [... I want to manage the books so that I can control them](#-i-want-to-manage-the-books-so-that-i-can-control-them)
        - [... I want to manage a book entry so that I can control the related details](#-i-want-to-manage-a-book-entry-so-that-i-can-control-the-related-details)
      - [As a user...](#as-a-user)
        - [... I want to browse book entry so that I have book suggestions](#-i-want-to-browse-book-entry-so-that-i-have-book-suggestions)
        - [... I want to see the challenges so that I am informed about the ongoing/upcoming challenges](#-i-want-to-see-the-challenges-so-that-i-am-informed-about-the-ongoingupcoming-challenges)
        - [... I want to be able to create an account so that I can participate in challenge](#-i-want-to-be-able-to-create-an-account-so-that-i-can-participate-in-challenge)
      - [As a member...](#as-a-member)
        - [... I want to see the challenges so that I am informed about the ongoing/upcoming challenges](#-i-want-to-see-the-challenges-so-that-i-am-informed-about-the-ongoingupcoming-challenges-1)
        - [... I want to be able to acess my account so that I have access to my personal details](#-i-want-to-be-able-to-acess-my-account-so-that-i-have-access-to-my-personal-details)
        - [... I want to be able to access my account so that can manage the book I read and reviews I made](#-i-want-to-be-able-to-access-my-account-so-that-can-manage-the-book-i-read-and-reviews-i-made)
    - [Must have (high priority) - for next sprint](#must-have-high-priority---for-next-sprint)
    - [Should have (medium priority)](#should-have-medium-priority)
    - [Nice to have (low priority)](#nice-to-have-low-priority)
      - [User account](#user-account)
      - [Admin](#admin)
      - [Home page](#home-page)
      - [Books](#books)
      - [Challenges](#challenges)
      - [Security](#security)
      - [Data](#data)
      - [Usability](#usability)
      - [For fun :)](#for-fun-)
    - [Memo](#memo)
  - [Team work feedback](#team-work-feedback)
    - [Was there too much to do? Too little?](#was-there-too-much-to-do-too-little)
    - [Work distribution](#work-distribution)
  - [What didn't work in the team?](#what-didnt-work-in-the-team)
  - [Was the division of labor clear?](#was-the-division-of-labor-clear)
    - [Planning](#planning)
  - [Code quality feedback](#code-quality-feedback)
    - [How high-quality / functional code you made](#how-high-quality--functional-code-you-made)
    - [Issues](#issues)
  - [Link to the published version on cPanel](#link-to-the-published-version-on-cpanel)

<!-- /TOC -->



## General

Start date: 03.02.2025
End date: 28.02.2025

Global goal: develop a minimal working version with all required features (design details such as colors, are not a priority)


## User stories and acceptance criteria

User roles:
  - user (can be logged in or not)

  Requires to be logged in:
  - admin
  - members (logged user)
    - student
    - teacher


### User story map

- Browse books
- View book details and reviews
- View ongoing challenge
- See progress in dashboard
- Mark book as read
- Add review to book
- Register/login


### Must have (high priority) - for this sprint

#### As an admin...


##### ... I want to manage the reading challenges so that I can control the planned challenges

*As an admin, I want to easily have access to all reading challenges so that I can easily manage them* 
  - The challenges should be displayed on a single page
  - The dates of each challenge should be displayed
  - The page to manage challenge should be easily accessible from the dashboard

*As an admin, I want to create a new reading challenge so that a new challenge is planned*
  - The challenge management page should enable to add a new entry
  - The new entry form should be easy and fast to fill
  - The form should allow to set a name for the challenge
  - The form should allow to set a start and end date for the challenge
  - The form should allow to set a description for the challenge

*As an admin, I want to edit existing reading challenge so that the challenge dates or details can be changed*
  - The challenge management page should enable to edit an existing entry
  - The form should display previous values 

*As an admin, I want to delete past challenges so that the challenge is removed from the database*
  - The challenge management page should enable to delete an existing entry
  - The form should display previous values 


##### ... I want to manage the registered users so that I can control the user accounts

*As an admin, I want to easily have access to all registered users so that I can easily manage them*
  - The registered users should be displayed on a single page
  - The following information should be displayed:
    - name
    - username
    - group (student/teacher/admin)
    - library card number (nice to have)
    - number of challenges attended -> not needed
    - number of books/pages read -> not needed

*As an admin, I want to give admin status to an existing account so that another admin can manage the website*
  - The group/status information of a registered user can be set as "admin"


*As an admin, I want to delete an user account so that he cannot login anymore*
  - The registered users management page should enable to delete an existing user
  - The reviews made by the user can be saved or deleted 
  - An admin can delete an admin account but not his own one (so that there is always at least one admin)


##### ... I want to manage the reviews so that I can check if the reviews complies with the chart

*As an admin, I want to easily have access to all reviews so that I can easily manage them*
  - The reviews should be displayed on a single page
  - The following information should be displayed:
    - book name
    - review
    - username
    - date of publication
    - possible actions (delete / "report" user)
  - The page to manage reviews should be easily accessible from the dashboard

*As an admin, I want to delete reviews so that inapropriate content is removed from the website*
  - The review management page should enable to delete an existing entry


##### ... I want to manage the books so that I can control them

*As an admin, I want to easily have access to all books so that I can easily manage them*
  - The books should be displayed on a single page
  - The following information should be displayed:
    - book/podcast/whatever name -> not needed here ; only for reviews. books entries gathered
    - author list
    - genre list
    - date of publication
    - illustration
    - how many people read it -> admin likely do not need this
    - how many reviews
    - average rating
  - The page to manage books should be easily accessible from the dashboard


##### ... I want to manage a book entry so that I can control the related details

*As an admin, I want to easily have access to a single book entry so that I can easily manage its information*
  - The book should be displayed on a pop up page
  - The following information should be displayed:
    - book/podcast/whatever name
    - author list
    - genre list
    - date of publication
    - illustration
    - how many people read it
    - how many reviews
    - average rating
    - list of all reviews
    - possible actions 
      - for the book: edit details / delete book entry
      - for the reviews: delete review / go to user information
  - The page to manage book entry should be easily accessible from the dashboard

*As an admin, I want to edit existing book entry so that its details can be changed*
  - The book entry page should enable to edit an existing entry
  - The form should display previous values 

*As an admin, I want to delete a book entry so that it is removed from the database*
  - The book entry page should enable to delete an existing entry
  
*As an admin, I want to delete a book review so that it is removed from the database*
  - The book entry page should enable to delete an existing review

*As an admin, I want to access user information from a review so that I can take action in case of inapropriate content*
  - The book entry page should enable to delete an existing review



#### As a user...

##### ... I want to browse book entry so that I have book suggestions (search book)

*As a user, I want to browse and filter books so that I find books that may like*
  - recommended
  - genre
  - authors
  - best raking
  - type (book, e-book, ...)




##### ... I want to see the challenges so that I am informed about the ongoing/upcoming challenges

*As a user, I want to know if there is an ongoing or upcoming challenge so that I can decide to participate*
  - the home page should display clear information about the challenges planned
    - if a challenge is currently happening
      - name
      - end date / time remaining
      - description
    - else if challenge planned
      - name
      - start and end date
      - description
    - else: no challenge planned
      - end date of last challenge
      - resume of last challenge

##### ... I want to be able to create an account so that I can participate in challenge

*As an user, I want to be able to create an account so that I can participate in challenge*
  - the home page should display a register button
  - the register form should contain the following information:
    - name (first + last name)
    - username
    - email address
    - password
    - group (student/teacher) -> not needed
    by default, user and not admin


#### As a member...

##### ... I want to see the challenges so that I am informed about the ongoing/upcoming challenges

*As an member, I want to know if there is an ongoing or upcoming challenge so that I can decide to participate*
  - the home page should display clear information about the challenges planned
    - if a challenge is currently happening
      - name
      - end date / time remaining
      - description
    - else if challenge planned
      - name
      - start and end date
      - description
    - else: no challenge planned
      - end date of last challenge
      - resume of last challenge


##### ... I want to be able to access my account so that I have access to my personal details

*As a member, I want to be able to login so that I have access to my personal/challenge details*
  - the home page should display a login button
  - the login form should contain the following fields:
    - ID: either username, email address, or library ID
    - password

*As a member, I want to be able to see my personal information so that I can check them*
  - the dashboard page should display the following information:
    - name
    - username
    - email address
    - library card number

*As a member, I want to be able to edit my personal information so that they stay up to date*
  - the dashboard page should display buttons to edit the following information:
    - name
    - username (but keep same ID)
    - email address
    - library card number

*As a member, I want to be able to delete my personal information so that my information is deleted from the system*
  - the dashboard page should display buttons to delete:
    - only the user data (but keep reviews associated to the account)
    - only the reviews data (but keep the account)
    - both the user and reviews data


##### ... I want to be able to access my account so that can manage the book I read and reviews I made

*As a member, I want to be able to see all the books I read so that I can keep track of what I already read*
  - The books should be displayed on a single page
  - The following information should be displayed:
    - book/podcast/whatever name
    - author list
    - genre list
    - date of publication
    - illustration
    - how many people read it
    - how many reviews
    - average rating
  - The page to manage books should be easily accessible from the dashboard

*As a member, I want to easily have access to a single book entry so that I can easily manage its information*
  - The book should be displayed on a pop up page
  - The following information should be displayed:
    - book/podcast/whatever name
    - author list
    - genre list
    - date of publication
    - illustration
    - how many people read it
    - how many reviews
    - average rating
    - list of all reviews
    - possible actions 
      - add a review (cf below)
      - for the review (only made by the member itself): edit/delete review
  - The page to manage book entry should be easily accessible from the dashboard

*As a member, I want to add a book that I read so that I can have access to it later in my dashboard*
  - Form to add a book
  - suggestion bar to prevent typo
  - if the entry does not exist, then the member fill the form (and add book to the book DB + review DB with empty fields)
  - if the entry exists, autofill + add to review DB with empty fields

*As a member, I want to add review for a book I read, so that I can give feedback on it*
  - Review: text
  - Rating: int
  - Recommended: boolean


*As a member, I want to see my progress for the current challenge, so that I have feedback*
  - number of books read
  - 


*As a member, I want to see my progress for all challenges, so that I have feedback*
  - number of books read
  - number of challenges attended (badges ?)
  - palkinto, if won any (name / date of challenge) ; badge with special effect

---



### Must have (high priority) - for next sprint




### Should have (medium priority)


*As a member, I want to download all information about me so that I am aware, and can check, what information I shared* [law :) ]
  - all account details
  - all book read
  - all reviews made
  - (personal note -> "nice to have")
  - CSV for book, reviews (,personal notes) + PDF for all (1 for each table -> select * where userID= ...)


### Nice to have (low priority)



#### User account

- At the end of the challenge, send the reward (likely a gift card?) to the winner's user account
- On the user's dashboard, display how many times completed the challenge
- Display tools such as timer, page/chapter counter, ...
- Mark other users as friends/followers ; see what they read/recommend

#### Admin

- Admin dashboard: display a banner on top of page that summarize the requests/actions/questions from users that need an action by the admin

#### Home page

- In case of daily challenges, display "X people completed the challenge today" / "User X completed the most daily challenges so far"


#### Books

- Take into account the different versions of a book (language, simplified version, ...)
- When adding a book (/marking as read), suggest books with close title (or whatever paremeter)
- Enable members to write a personal note about a book (a comment, a paragraph they liked, a memo about until which page number they read the book,...)
  - only visible by this user (a priori, no need for admin to see it)
- Add "theme" to describe books

#### Challenges

- When a new challenge is planned, notify members (also reminder at day D-7?)
  - when user register, ask if they want to receive such notifications ; and can (un)subscribe at anytime from their dashboard
- Prevent the admin to edit the challenge less than 24 hours before the begining of the challenge

#### Security

- A bot that scan the reviews to prevent inapropriate content (censor, alert the admin, warn the user). Possible to scan in real time while user is typing the comment (i.e. before actually posting it)? For some books, it may be acceptable to have e.g. swear words if it is language book about swearing)

#### Data

- query on Toki (PIKI?) kirjasto to see availability in near libraries
  - beta version: redirect to Toki's search page with filled key words
- use an API (https://publicapis.io/open-library-api-api) to fetch data and add to own database when needed?


#### Usability

- Enable to change language
- Enable to switch between light/dark modes

#### For fun :)

- At the very end of this project, give the instructions to chatGPT and see what he can do ; compare to our own project






### Memo

- à penser : confirmation quand on édite ou qu'on supprime (bouquin, review, user...)

- quand utilisateur ajoute un bouquin, si le genre n'est pas dispo, pouvoir l'ajouter 
  - passer par une table temporaire
  - faire valider par l'admin
  - permet à l'utilisateur de pouvoir ajouter un bouquin avec une catégorie temporaire, sans devoir attendre l'admin




## Team work feedback


### Was there too much to do? Too little?


### Work distribution


What worked in the team?
  - communication
  - idea sharing

What didn't work in the team?
  - 

Was the division of labor clear?
  - 


### Planning


Did you do enough planning before coding?


Were user stories understandable and clear?


Were the daily meetings useful, was the role of the leader of the meeting clear?


## Code quality feedback


### How high-quality / functional code you made




### Issues


What problems came up? How were they solved?


## Link to the published version on cPanel
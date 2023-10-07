# PHP Task Assignment - Upwork

## Description

The task is completed using Vanilla PHP and CURL APIs. Moreover, Bootstrap is used for styling purposed.

## Task Distribution

### index.php

* This file contains the layout of Login Page by which you can login to the App using provided API via 'POST' request.


### authors.php

* This file is able to fetch and list the authors (in tabular form) that we are fetching using API.
* Also, there is an option to against each record to 'Delete an Author' using 'DELETE' request through API.
* Moreover, 'View Author Details' another option for each record is also available on this page.

### authors_details.php

* This file will show the details of author, which includes:
	* Personal details of the Author
	* List of all 'Books' owned by the Author (in tabular layout)
	* For each 'Book' there is an option to 'Delete Book'
* Additionally, on this page there is a button named as 'Add New Book'. And the logged in 'User' can use this feature to add book against a specific author.

### add_new_book.php

* This file contains a simple for to add new book, logged in 'User' just need to fill out the form and save the details to add book.
	* Moreover, on this form there is a 'select box' which has options of all the available 'Authors'. This author list is also fetched using the 'GET' request through API.

### functions.php
* This is a common file included in all other files except 'logout.php' file.
* This file contains various user defined PHP functions which I am calling whereever it is needed.
ex. To get logged in on 'index.php' page, the 'loginApiCall()' is called.

### logout.php
* This file simple logs out the user and terminates all the running sessions.
* Morever, user cannot access the web pages of the project until unless its logged in.


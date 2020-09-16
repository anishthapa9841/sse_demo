# Server-sent Event Demonstration in (PHP, JAVASCRIPT)

This project borrows the idea of server-sent event from MDN web docs. According to which the notification event is pushed from the server i.e. in our case php server. This project tries to mimic the comet concept of the server push. It uses EventSource web API found in MDN web docs. And in the server-sent end runs a php script which pushes event stream inside a continues while loop. In the backend there is a mysql database with two tables tbl_notification and tbl_notification_consumer whose details is found in db_sse.pdf.

## Installing

To test this project
```bash
git clone https://github.com/anishthapa9841/sse_demo.git
```

## Importing database

In the project root directory there you will find a dump file i.e. db_sse_dump.sql then run this dump file in your database server.

## What this sample project does? 

In this project index.php shows the events when this page is loaded. sse.php is the page which checks for the any new event in every 5 sec. And test_sse.php is the file which will test the code and populate the database for events


### Prerequisites

you will need following this installed in your development enviroment to run this project
* [php](https://www.php.net/downloads)
* [mysql](https://www.mysql.com/downloads/)


### Project structure 

```bash
├── index.php                   
├── sse.php
├── db_sse_dump.sql                 # mysql db scheman dump file
├── db_sse.pdf                      # database er diagram and schema doc
├── test    
│   └── test_see.php				
└── README.me 					    # basic documentation and getting started doc.
```

### Getting started

After project setup start the web server in your apache/ xampp server/ php inbuild server.

For eg start php inbuild server inside the project as the base dir
```bash
php -S 127.0.0.1:8080
```

## Authors

* **anishthapa@live.com** - [projects](https://github.com/anishthapa9841)


## Acknowledgments

* [Mozilla Firefox Doc on using server-sent event] (https://developer.mozilla.org/en-US/docs/Web/API/Server-sent_events/Using_server-sent_events)




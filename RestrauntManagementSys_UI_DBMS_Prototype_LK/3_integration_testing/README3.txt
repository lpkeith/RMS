My integration testing was a lot of trial and error trying to get the database and web docs 
to communicate.

I spent a lot of time on the inventory.php page attempting to insert data via the form.

I was finally able to communicate with the database. 

However, the major bug that I am dealing with at this moment is that data is entered
each time the page is refreshed. 


I finally had success with Flask for Python. At this point I knew there was not an issue with my dbms-- 
it had to be my syntax in php. I included my python code that I used for this testing here. 


To run the tests I did, one would need:

Python v3.11
pip 23.1.3
Flask 2.3.2
pymySQL 1.0.3


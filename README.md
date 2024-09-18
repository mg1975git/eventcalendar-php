<h1>EventCalendar</h1>
EventCalendar is a simple event management software, reminders, and commitments on a digital calendar developed in PHP.</br>
You can insert, modify, and delete multiple events for the same month; viewing is possible by clicking on a day or a month.</br>
The version is in beta, so it is useful as a starting point to create a large project.</br>

<h1>Installation and Usage</h1>
Install PHP, Apache and MySQL<br/>
Download project from here GitHub<br/>
Create the "eventcalendar" database with MySQL and run the script inside the sql folder to create the tables.<br/>
Create the site under .\Apache24\htdocs</br>
Reminder username and psw to insert into <i>db_connect.php</i> </br>
Start EventCalendar with browser to localhost ..., which will display the login page.</br>
Use the user registration form to begin. Once registered, you can log in with your username and password (see below for the email code).</br>
Create events by selecting a day.</br></br>
Language management:</br>
The file <i>label.php</i> corresponds to the labels of a language you want to display: it is an array, so you can feed as many languages as you want and call the array index in <i>lang.php</i> for the desired language.</br>
Currently, labels and messages are available in Italian and English.</br></br>
(The email code can be found inside <i>register_save.php</i>)</br>

<h1>Informations</h1>
<ul> 
    <li>Login management</li> 
    <li>Language management for labels and messages</li> 
    <li>User registration</li> 
    <li>Duplicate user control</li> 
    <li>Token validity for an open session: 24 hours</li> 
    <li>General calendar: scrolling year list, event insertion, modification, deletion</li> 
    <li>Event overlap control</li> 
    <li>Total event view, partial day view, partial month view</li> 
    <li>Contact directory and its management</li> 
    <li>User settings modification except username</li> 
    <li>MySQL database as table storage</li> 
</ul>

<h1>Requirements</h1>
PHP version: 8.2.0</br>

<h1>License</h1>
Copyright (c) 2024 M.G. https://www.mg975.it

Licensed under the MIT license

<h1>Like it?</h1>
Did you like my project? Hit star button!<br/>
Donate with PayPal <a href="https://www.paypal.com/donate/?business=WY533CP7VDC24&no_recurring=1&item_name=I+will+dedicate+more+time+and+resources+to+improving+and+maintaining+this+work.&currency_code=EUR" target="_balnk">here</a><br/>
Contact me for collaborations.<br/><br/>
Thank you.<br/>
<img src="https://github.com/user-attachments/assets/55e5568a-89ed-4554-b7fb-e795f95896d4" alt="preview" style="max-width: 100%;"><br/>
<img src="https://github.com/user-attachments/assets/1e9de6a5-889f-4f23-bbf1-fc8cdba3aeaa" alt="preview" style="max-width: 100%;"><br/>
<img src="https://github.com/user-attachments/assets/f49e820d-3bab-4683-a45b-29349cbb7b36" alt="preview" style="max-width: 100%;">

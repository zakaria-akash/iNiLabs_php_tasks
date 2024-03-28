# PHP Complete CRUD Application: To-Do-List App

### \***\*Copy files to htdocs folder\*\***

Download the above files. Create a folder named _iNiLabs_ inside _htdocs_ folder in _xampp_ directory. Finally, copy the _iNiLabs_ folder inside _htdocs_ folder. Craete a MySql Database in PHPMyAdmin of the XAMPP server named as "to_do_list".
<br />
Under the database "to_do_list" create a table named "todos" with the following command:
<br />
CREATE TABLE `todos` (
`id` int(11) NOT NULL,
`title` text NOT NULL,
`date_time` datetime NOT NULL DEFAULT current_timestamp(),
`checked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
<br />
Now, visit [localhost/iNiLabs](http://localhost/iNiLabs) in your browser and you should see the output for all tasks assigned and visit [localhost/iNiLabs/task5](http://localhost/iNiLabs/task5) in your browser and you should see the project of To-Do-List App of task_5. Thank you.

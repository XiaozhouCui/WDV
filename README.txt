Domain: 
https://www.joesdemosite.com

GitHub repo address:
https://github.com/XiaozhouCui/WDV

IMPORTANT INFO:
Default Admin account login
username - admin
password - admin

New features:
Control panel moved into a toggled side bar
Bootstrap grid layout applied to forms, navbar and footer.
AJAX and other javascript demonstrations are saved in the page: view/pages/ajaxPage.html (can be accessed via the "AJAX Tricks" button in the admin control panel)

Website overview:
SafeTec Pacific website is built as an online Learning Management System, supporting our offline courses provided in company's office. 
Anyone who are interested in the courses can register and apply  online. Once the prospective students are enrolled by admin, they can interact with the company and their trainers on the website through the Learning Management System.
The Learning Management System can handle the information of courses, classes, students, trainers and training materials. For example, any visitor can register their interest and became a prospective student. Once the prospective student is enrolled into a class by the admin, he or she then becomes a current student. A trainer can upload training materials. A current student can check the status of his/her class, browse training materials, check class notice board, and join the online discussion with trainers and fellow students.


Login as 4 different roles (access levels): 
Admin
Trainer
Current student
Prospective student (customer)


Functionalities achieved so far:
Registration and login
Any visitor can register as a prospective student.
After login, different roles will see different control panels.
Admin user can create/read/update/delete any account of any role.
Admin user can create/read/update/delete any course.
Admin user can create/read/update/delete any class.
Admin user can enrol a new student into a class(convert a prospective student into a current student).
Admin user can browse all the enrolled students of a particular class, and edit the student details from there.
Trainer user can create, browse and edit classes.
Trainer user can upload files to any class and can delete them.
Current Students can Browse their own classes information.
Current Students can download files from their own classes.
Admin and trainer can upload files to the class folders.
Once a file is uploaded, a record will be inserted into the database.
Admin and trainer can browse and delete all uploaded files.



Other progress so far:
Website is put online at https://www.joesdemosite.com
Custom modals are applied to indicate success and error.
header('location:') caused error on the domain, they are replaced by modals with redirection button.
Modals are applied to indicate success and error.
Ajax is applied in registration form to check if the username and email address exists. If exists, submit button will be disabled.
Ajax is used to render the information from database into the 'Add Class Form' dropdown selections.
AJAX is used to create/read/update/delete admin accounts.
AJAX is used to display all uploaded files.
SVG loading animation is added while AJAX is being loaded.
javascript is used to show/hide password in input fields.
javascript is used to validate admin user add/edit forms.
javascript is used to remember login username using local storage.
3rd party js component 'dropzone' is used to upload pictures.

MCV architecture, everything is called from index.php
GIT repository is setup, all changes will be committed and pushed to GitHub
Custom modals are added to show operation feedbacks.
jQuery CDN is added
Bootstrap CDN is added


To do list:
Complete the missing HTML pages
Update the CSS file
Apply more jQuery and AJAX


To be added in the future:
Course order (new content type)
Discussion message (new content type)
Trainer can publish on class notice board (new functionality)
Trainer can leave a message (new functionality)
Student can leave a message (new functionality)
Record history of change (new functionality)
Prospective student can add a course to a shopping cart (new functionality)
Prospective student can check out through a payment gateway (new functionality)

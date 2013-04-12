RED
===

Welcome! RED is an MVC-inspired framework created by Henrik Lundqvist as a part of the course PHPMVC at BTH. spring semseter 2013.
The framework was created mainly following a tutorial for the framework Lydia by Mikael Roos.

How to install RED:
===================

Download
--------

The first thing you have to do is to clone RED from Github, this can be done either manually from the link:
    
    https://github.com/Lyssas/RED/

Or by using the git command:
     
     > git clone git://github.com/Lyssas/Red.git 

The source code of RED can be reviewed directly at:

    https://github.com/Lyssas/RED/
    
Installation
-----------
The installation of RED consists of 3 simple steps, simply follow them in order.

1.
--

First off, locate the file named .htaccess, it is located in the RED root folder.
In the file you will find a line which looks like this:

    # RewriteBase /~helu13/phpmvc/kmoment7/RED/
    
If you are attempting to install RED on the BTH server you will have to edit this line do point the directory at the location
where your RED root folder is located. You will also have to remove the comment hash tag. When you are done is should look
something like the following:

    RewriteBase /~yourAcronym/yourFolder/eventualSubfolder/RED/
    
Save the changes to the file and proceed with the next step of the installation.

2.
--

RED uses a database to store content and information about users. For this to work the database and the folder in which it is
located must be made writable, otherwize the setup will fail during the next step. To achieve this, change the settings of both
the database file and its folder to 777 manually using a program such as FileZilla, or use the git command:

    > cd RED; chmod 777 site/data
    
You are now able to proceed to the final step of the installation.

3.
--

RED comes with a bit of default content and default users. All of these can be deleted at any time later on if you do not wish to keep them.
You will however need to initialize the database to be able to log in as an admin of the site. The default admin user is named "root" and the password is also "root". 
Simply point your browser to the following link and follow the instructions there:

    > www.your-install-path.com/RED/module/install 
    
You have now completed the installation of RED. The guide below will show you how to use basic functions of the framework and how to configure the framework
to your liking.
    
    
    






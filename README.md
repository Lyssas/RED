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
    
    
Configure RED
=============

In this section we cover how to configure parts of the framework to your liking.

Changing the logotype
---------------------

The framework comes with a standard logo. If you prefer to use another logo, simply follow these steps.

The standard logo is stored in: 

    RED/themes/grid/
    
and is callled:

    logo_80x80.png
    
If you do not care about keeping the standard logo simply replace this file with another containing your prefered logo (you can always copy the original logo and save it somewhere if you want to put it back)

You can also put your own logo (with any name) in the folder:

    RED/themes/grid/
    
Then configure the file:

    RED/site/config.php
    
In the file you will find the following array:

    $this->config['theme']
    
This array controlls the configuration of the site's theme. To change the logo, look up the following line:

    'logo' => 'logo_80x80.png',
    
and change it to:
    
    'logo' => 'yourLogoName',
    
Save the changes and upload to your server. The changes should now be working.


Changing the website title (slogan)
-----------------------------------

To change the page title (slogan) simply open the file

    RED/site/config.php
    
In the file you will find the following array:

    $this->config['theme']
    
This array controlls the configuration of the site's theme. To change the title (slogan) look up the following line:

    'slogan' => 'A PHP-based MVC-inspired CMF',
    
And change it to:

    'slogan' => 'Your title',

Save the changes and upload to your server. The changes should now be working.


Changing the website footer
---------------------------

To change the page footer simply open the file

    RED/site/config.php
    
In the file you will find the following array:

    $this->config['theme']
    
This array controlls the configuration of the site's theme. To change the title (slogan) look up the following line:

    'footer' => '<footer id = "bottom"><p>&copy; RED by Henrik Lundqvist. Inspired by and created with tutorial for &copy; Lydia by Mikael Roos (mos@dbwebb.se)</p></footer>',
    
And change it to:

    'footer' => '<footer id = "bottom"><p>Your footer</p></footer>',

Save the changes and upload to your server. The changes should now be working.


Changing the navigation menu
----------------------------
To change the navigation menu you have to go through two steps.

1.
--

To change the page footer simply open the file

    RED/site/config.php
    
In the file you will find the following array:

    $this->config['menus']
    
This array stores the navigation menus of the framework. The code below shows an example of how a navigation menu is built up, this menu is called "my-navbar":

    'my-navbar' => array(
    'home'      => array('label'=>'About Me', 'url'=>'my/aboutme'),
    'blog'      => array('label'=>'My Blog', 'url'=>'my/blog'),
    'guestbook' => array('label'=>'Guestbook', 'url'=>'my/guestbook'),
  ),
  
To create your own menu simply follow the syntax above and write your own menu, the syntax is further described here:

    'YourMenuName' => array(
    'internalButtonName'      => array('label'=>'nameVisibleOnSite', 'url'=>'controller/method'),
    
Once you are satisfied with your menu, proceed to step two.

2.
--

You have now created your own menu, now you have to tell the framework this is the menu you want to use.

Stay in the file:

    RED/site/config.php
    
In the file you will find the following array:

    $this->config['theme']
    
This array controlls the configuration of the site's theme. To change which navigation menu is used you have to look up the following line:

    'menu_to_region' => array('my-navbar'=>'navbar'),
    
Change the line to your own menu, i.e:

    'menu_to_region' => array('YourMenuName'=>'navbar'),
    
Save the changes and upload to your server. The changes should now be working.    
    

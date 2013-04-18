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

In this section we cover how to configure parts of the framework to your liking. If you are comfortable working with
CSS you can open the file

    RED/site/themes/mytheme/style.css
    
In this file you can change mostly anything on the site, for instance background colors and fonts. If you wish to further customize
your page the guide below shows how to customize the logotype, the page title (slogan), the footer, and the navigation menu.

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


Create content in RED
=====================

Red comes with some default content, it is however more than likely that you wish to create some content of your own. Currently
RED supports two types of content, posts and pages. This section will show you how to create contents of both types.

The first thing you must do is to log in as admin, the default admin user and password is root:root (it is advised that you change the password or create a new personal admin user if you intend to use RED for a live website).
Once you have logged in head over to:

    ../RED/content
    
In the list of Actions on this page you can select "Create content", click the link.

You have now been directed to the form for creation of content, below follows a quick description of the fields:

Title = The title of your content.

Key = Internal key to uor content. Can not handle blank spaces, thus name accordingly: "my-content" or "my_content".

Content = Here is where you put your content.

Filter = Decides which filter is applied on your content: I'd recomend to use "htmlpurify" which allows you to use html.
All the filters available are:

    htmlpurify
    bbcode
    plain
    
Type = This is where you decide whether your content should be a page or a post. Simply enter either "page" or "post".

When you have filled out all the fields, click the "Create content" button. You have now created your own content.


Creating your own page
======================
This part of the tutorial will show you how to create your own page. Pages can be either static, or connected to your database.

The first thing you have to do is go to the file:

    RED/site/src/CCMycontroller/CCMycontroller.php
    
In this file each page is represented by a public function. Let as look at an example:

    /**
    * The page about me
    */
    public function Aboutme() 
    {
        $content = new CMContent(1);
        if($this->config['require_permissions'] == true)
        {
            $this->user->CheckGroupPageRights();
        }
        $this->views->SetTitle('About Me');
                $this->views->AddInclude(__DIR__ . '/page.tpl.php', array(
                  'content' => $content,
                ));
    }
    
This code represents an aboutme page.

To create your own page, simply copy and paste this function and change the following things:

1. The comment describing the function. Change this to describe your own page.
2. The name of the function. Change the line "public function Aboutme()" to "public function Yourpage()" 
3. Change the "1" in the line "$content = new CMContent(1);" to the id of the content you wish to show on your page. You created the "page content" in the previous step of this tutorial. 
4. Finally, change the line "$this->views->SetTitle('About Me');" to "$this->views->SetTitle('Your title');"

This page makes use of a connection to the database. It is possible to create a page which does not make use of this connection. 
To do this; follow the first two steps above. When you get to stage 3. simply remove the "1". Then follow the steps below:

1. Change the line:

         $this->views->SetTitle('About Me'); 
        
to 

         $this->views->SetTitle('Your title');


2. Change:   

        $this->views->AddInclude(__DIR__ . '/page.tpl.php', array(
                  'content' => $content,
                ));"
       
       
to: 


        $this->views->AddInclude(__DIR__ . '/yourPage.tpl.php');
        
    
3. In the same folder as CCMycontroller, create a new file called "yourPage.tpl.php".
4. Open "yourPage.tpl.php" and write your own HTML.

You have now created your own page using RED. Now you would probably want to configure the navmenu to add your new page.
Simply open the file:

    RED/site/config.php
    
and scroll down to the following part:

    'my-navbar' => array(
    'home'      => array('label'=>'About Me', 'url'=>'my/aboutme'),
    'blog'      => array('label'=>'My Blog', 'url'=>'my/blog'),
    'guestbook' => array('label'=>'Guestbook', 'url'=>'my/guestbook'),
    ),
    
Now finally, add your page, it should look like this:

     'my-navbar' => array(
    'home'      => array('label'=>'About Me', 'url'=>'my/aboutme'),
    'blog'      => array('label'=>'My Blog', 'url'=>'my/blog'),
    'guestbook' => array('label'=>'Guestbook', 'url'=>'my/guestbook'),
    'yourpage' => array('label'=>'Your Page', 'url'=>'my/yourpage'),
    ),   
    
Your new page should now be available at:

    /RED/my/yourpage
    
or by clicking the navigation button you just created.

Create a blog
=============
RED handily comes with a blog which you can use. Content can be added as described previously in this tutorial and the default posts can be removed from the
admin controll panel. You can reach your blog by clicking the button 'My Blog' in the default navigation menu, or by pointing your browser to:

    /RED/my/blog
    


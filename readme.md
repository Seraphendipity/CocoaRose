# COCOAROSE PROJECT SITE
- [GitHub Page](https://github.com/Seraphendipity/CocoaRose)
- [Demonstration Video](https://youtu.be/y4wpxXwUTAY)

Hello there, this is a brief overview of the CocoaRose site and what you can do with it since the last major update.
Note this file is in Markdown format, and I'd recommend reading via your own markdown tool. A `readme.md` is also provided.


## Setup
Firstly note that you need [XAMPP](https://www.apachefriends.org/index.html) or a substitute to host the site as there is no persistent server as of yet.
For simplicity, the database info are as follows: `database='cocoarose'`, `username='root'`, `password=''`(none).
You can change these settings in `./Resources/db_connect.php` inside the first function, db_connect, if you so desire, these
values are meant for testing. You can then use phpMyAdmin (or similar software) to import the `cocoarose.sql` in the `./Database/`
directory. 

<span style="color: red">NOTE: since not all data is stored on the server -- images by design are in a seperate images folder, archives by
failure of implementation yet are still stored only in the `./Archive/` directory and Contacts are stored in the `./Database/contactEntries.csv` --
the SQL info only pertains to the image metadata, and thus assumes you are copying over the relevant image files as well.
There is no checking as of yet for the database and `./Images/` matchups.</span>

## Walkthrough of Site
All of the main navigable pages are in the Main/ folder. `./Main/home.php` is the default page, so navigate to
[localhost:XXXX/htdocs/CocoaRose/Main/home] (or the equivalent on your server, XXXX depending on if youre using a different port).
The site supports "pretty urls", that is, the file extension `.php` is unnecessary.

From here you can view previews of the `archives` and `images` pages. The navbar at the top can take
you to the general content areas:
- Archive: Contains both the grouping of all archives in picture blocks with their title.
            Additionally can click on those blocks to view the associated archive page.
            These archive posts are brought in via HTML, but are themselves generated from the 
            `.md` files in the sub directory `./Archive/`. Any changes to the HTML directly
            will be overwritten by changes in the markdown files after the `convertToHtml.cmd`
            batch file is run. This batch file uses [pandoc, a very useful conversion tool](https://pandoc.org/installing.html).
            There is no current way to submit changes to the server without accessing
            these files.
            
- Images: shows all images of the SQL server (a buffer or limit or lazy load mechanic has not yet
            been implemented, so be wary of having hundreds of photos). You can click on the 
            question mark button in the top-right corner of the image tag
              ![Image Tag Question Mark Button](./Images/README-IMG-imgQuestionmark.png)
            to view some metadata om each image. Slternatively, click the image for a modal window pop-up
            (you may need to scroll up), which allows you to edit the image metadata.
            You can also import new images via the plus button in the lower-right of the sceen. The image meta data is stored and 
            retrieved via a sql table (images), though the images themselves are stored in the server directory `./Images/`, as
            many CMS's do. Note that POST-REDIRECT-GET methodlogy is used, so refreshing the browser after
            a submission does not make it twice. This also means since I do not have an error page that if something goes wrong you
            may be "stuck" on form-handler page. This should only occur if something went wrong with connecting to the database.
            If so, press back and try again or report it to elirose@uab.edu.

- DB Control: a debugging tool used to quickly wipe and set up tables again. One can ignore, as this feature likely
                will be removed in a future update or set behind admin logins.

- Contact Page: currently exports to a `.csv`, not the SQL server, and does not automatically mail me so cannot be 
                really used as of yet for its designed purpose (I did not want a thousand test email sent to me).

## Backend
If one wishes to view the backend, all of the pages you visit are nominall in the `./Main/` folder.
Most of the logic, headers, and `.php` code is in the `./Resources/` directory. Scripts and Styles 
are in their associated directories of course. Styles are in long-list right now instead of
seperate documents due to CSS performing [a seperate call to the sever for each import](https://www.giftofspeed.com/avoid-using-css-import/),
as such until I move to SASS, they'll mostly be in one file.
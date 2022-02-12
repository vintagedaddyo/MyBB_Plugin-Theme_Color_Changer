/*
* MyBB: Custom Color Changer
*
* File: readme.txt
*
* Authors: AmazOuz & Vintagedaddyo & iAndrew
*
* MyBB Version: 1.8
*
* Plugin Version: 1.2
*
*/

Custom Color Changer * (1.2): 

* Install a color changer in your forums & let every member choose their color


To Install:

Upload the files found within the "Upload" folder to your forums directory, And Go to Admin CP And Activate!


Backend usage:

Default Hex Color:
- Write here the hex of the default theme color. Example: for #008dd4 write 008dd4

Ie:

008dd4

Custom Text Color Elements:
- Write here Classes & Ids (separated by comma) of elements for which you want to change the text color

Ie:

.top_links a:link, .top_links a:hover, .top_links a:focus, .top_links a:visited, .navigation a:link, .navigation a:hover, .navigation a:focus, .navigation a:visited, .trow1 a:link, .trow1 a:hover, .trow1 a:focus, .trow1 a:visited,  .trow2 a:link, .trow2 a:hover, .trow2 a:focus, .trow2 a:visited, #footer .lower span#copyright  a:link


Custom Border Color Elements:
- Write here Classes & Ids (separated by comma) of elements for which you want to change the border color

.postbit_buttons > a:link


Custom Background Color Elements:
- Write here Classes & Ids (separated by comma) of elements for which you want to change the background color

#search input.button, .thead






Note: You have to use the correct identifiers, there are tons you can use and the ones below are just to get your brain on the thought process,  also note that for some items you might also need also to remove image attributes from the css on the respective items else some elements with such it may not work properly...

Anyhoo, as you see you can think of and come up with all sorts elements to specific color/style and ways to use such....

table a:link, .top_links a:link, a:link, a:hover, a:focus, a:visited, #panel .lower ul.panel_links a:link, #panel .lower ul.panel_links  a:visited, #panel .lower ul.panel_links a:hover, #panel .lower ul.panel_links a:active, #panel .lower ul.user_links a:link, #panel .lower ul.user_links  a:visited, #panel .lower ul.user_links a:hover, #panel .lower ul.user_links a:active, #footer a:link, #footer a:visited, #footer a:hover, #footer a:active

.thead, .tfoot, #search input.button, .postbit_buttons > a:link

#panel, .tfoot, .upper, .thead, .tcat, #footer, #copyright, .breadcrumb, #header

.post_block h3, .post_block h3 a, .trow1 a:link, .trow2 a:link, #logo ul.top_links a:link, #panel .lower a:link, .navigation a:link


Etc, etc, .....




Current localization support:

- english 
- englishgb
- espanol
- french
- italiano


What is new in version 1.2?

- finally had some free time to complete the localization support had set files up for but not fully implemented back a few years ago when applying a quick fix of the plug for a user request at that time and at time only did such and never got around to any other planned adjustments

- removed alot of the unneeded files in package as well as linked links of such unneeded in the plug code as well of such no longer needed and some were not even needed back in say 2016 as I mentioned via the tutorial this was based off of.

- package dir re-order / restructured

- added the past touch support I provided back in 2016 for a user request via the tutorial this was based off of

- returned the picker back to full picker as it was back in 2016 via tutorial shares

- added documentation

- added actual all author credits seeing as this was based off the tutorial, said shares provided via such, etc, etc and such is only polite to do as such appears to have been forgotten initially. ;)


To-do:

- Tweak any styling needed now that added the past touch specific files, if and or when I may have free time to do so

- cleanup any remaining unneeded files

- hmm, maybe provide duplicated version but with the alternate light colored bg picker like shared via a theme in the past via the old tutorial

- dunno, whatever else... lol

- find free time, haha!

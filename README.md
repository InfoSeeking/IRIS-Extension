IRIS-Extensions
===============

The following repository will be used for the development of possible IRIS extensions.

The IRIS repository can be found at https://github.com/InfoSeeking/IRIS

Find out more information about IRIS at http://iris.infoseeking.org/

=====
## Table of Contents:

[Directory Structure](https://github.com/InfoSeeking/IRIS-Extension#file-structure)

[Adding a Function](https://github.com/InfoSeeking/IRIS-Extension#adding-a-function)

[Troubleshooting](https://github.com/InfoSeeking/IRIS-Extension#troubleshooting)


====
####Directory Structure [[^]](https://github.com/InfoSeeking/IRIS-Extension#iris-extensions)
* responses
  * analyse.php `for stack operations`
  * curr_analyse.php	`for current page operations`
  * reply.txt 
* sidebar	
  * index.php `contains main sidebar`
  * jquery.min.js	
  * style.css 
* SQLConnect.php `Connecting to SQL server, please modify this before using`
* addRes.php `Adds resource to stack`
* clearRes.php `Clears stack - initalizes a new stack for user so old stack is discarded`
* delRes.php `Currently not used`
* getCurrent.php `Gets current title, url and search`
* help.html	`Undeveloped help-page`
* saveURL.php	`Saves URL with browser change`
* stackID.php	`Fetches the current stackID`
* utilityFunctions.php  `Contains extract query code`

===
###Adding a Function [[^]](https://github.com/InfoSeeking/IRIS-Extension#iris-extensions)

To add a function,  **sidebar/index.php** *and* (**responses/analyse.php** *or* **responses/curr_analyse.php**) must be modified.

In index.php you must:

**1**.Add a button for the module 
`<button class="module" id = "nameofmodulem">-</button>`

**2**.Add a form for the module
```
<form id = "nameofmodule" class = "requestForm">
<input name="requestType" value="nameofmodule" class = "hide">
<input type="submit" name = "submit" value="Name for summit button" class = "curr_submit/stack_submit">
</form>
```
The current naming scheme is that the button has a 'm' following the module name. i.e. the extract button has id `extractm`, while the extract form has the id `extract`.

**3**. Enable toggle by finding the line `$('.module').click(function(){` and adding your module.

**4**. If your module is for the current page, add the id of your module to the if statement contained within `$(".requestForm").submit(function() {`

If your function is for current page analysis, modify curr_analysis.php.

If your function is for stack analysis, modify analysis.php.

For either file, mimic or modify existing else-if statements to suit your function. Remember that you should be adding a block of code for both retrieving the information from the form and for outputting an result to IRIS.

===
####Troubleshooting [[^]](https://github.com/InfoSeeking/IRIS-Extension#iris-extensions)

* For troubles pertaining to IRIS, please refer to https://github.com/InfoSeeking/IRIS first.
* Issues when adding a module usually falls in one of the following catagories:
 * Sending the information from form to php file for analysis
   * Make sure all input fields match post in php file. They *are* case-sensitive.
    * Check whether it is an issue on the javascipt end. Troubleshoot by changing a visible html to output or using Firefox Developer Tools Console.
 * Modifying information retrieved in php file to correct format for IRIS.
   * If one of your inputs contains text that many contain spaces, make sure it is url encoded.
    * Test whether the xml produced can be analysed by IRIS by using the [Requester Tool](http://iris.comminfo.rutgers.edu/tests/requester/) or a curl request `curl --data "xmldata=<xmlhere> http://iris.comminfo.rutgers.edu/index.php`
     * Check error_log for possible solutions.
